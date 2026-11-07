<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestPortalController extends Controller
{
    /**
     * Halaman Cek Poin Tamu
     */
    public function index(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $phone = preg_replace('/[^0-9+]/', '', (string) $request->input('phone'));

        $guest = null;
        $searched = false;
        $notFound = false;

        // Pencarian aktif jika ada input nama atau nomor HP
        if ($request->has('name') || $request->has('phone')) {
            $searched = true;

            if (!empty($name) && !empty($phone)) {
                // 1. Cari yang cocok Nama DAN Nomor HP
                $guest = $this->queryGuestByBoth($name, $phone);

                // Jika tidak ketemu persis keduanya, cari berdasarkan Nomor HP
                if (!$guest) {
                    $guest = $this->queryGuestByPhone($phone);
                }

                // Jika masih belum ketemu, cari berdasarkan Nama
                if (!$guest) {
                    $guest = $this->queryGuestByName($name);
                }
            } elseif (!empty($phone)) {
                // 2. Cari berdasarkan Nomor HP saja
                $guest = $this->queryGuestByPhone($phone);
            } elseif (!empty($name)) {
                // 3. Cari berdasarkan Nama Lengkap saja
                $guest = $this->queryGuestByName($name);
            }

            if (!$guest) {
                $notFound = true;
            }
        }

        return view('guest.check-points', [
            'guest' => $guest,
            'searched' => $searched,
            'notFound' => $notFound,
            'searchName' => $name,
            'searchPhone' => $phone,
            'roomRates' => Guest::ROOM_RATES,
            'tiers' => Guest::TIERS,
            'redeemCatalog' => Guest::REDEEM_CATALOG,
            'banquetRevenuePerUnit' => Guest::BANQUET_REVENUE_PER_UNIT,
            'banquetPointsPerUnit' => Guest::BANQUET_POINTS_PER_UNIT,
        ]);
    }

    /**
     * Halaman Khusus: About Senyum Stay Priority
     */
    public function about()
    {
        return view('guest.about');
    }

    /**
     * Halaman Khusus: Membership Tiers & Privileges
     */
    public function tiers()
    {
        return view('guest.tiers', [
            'tiers' => Guest::TIERS,
        ]);
    }

    /**
     * Halaman Khusus: How to Earn Points
     */
    public function earn()
    {
        return view('guest.earn-points', [
            'roomRates' => Guest::ROOM_RATES,
            'banquetRevenuePerUnit' => Guest::BANQUET_REVENUE_PER_UNIT,
            'banquetPointsPerUnit' => Guest::BANQUET_POINTS_PER_UNIT,
        ]);
    }

    /**
     * Halaman Khusus: Rewards Redemption Catalog
     */
    public function catalog()
    {
        return view('guest.rewards-catalog', [
            'redeemCatalog' => Guest::REDEEM_CATALOG,
        ]);
    }

    /**
     * Halaman Khusus: Frequently Asked Questions (FAQ)
     */
    public function faq()
    {
        return view('guest.faq');
    }

    /**
     * Proses penukaran poin tamu
     */
    public function redeem(Request $request)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'item_id' => 'required|string',
            'selected_option' => 'nullable|string|max:150',
            'notes' => 'nullable|string|max:500',
        ]);

        $guest = Guest::findOrFail($validated['guest_id']);
        $item = Guest::findRedeemItem($validated['item_id']);

        if (!$item) {
            return back()->with('error', 'Reward redemption item not found.');
        }

        $cost = $item['points_cost'];

        if ($guest->points < $cost) {
            return back()->with('error', "Insufficient point balance to redeem {$item['title']}. Points required: {$cost}, your balance: {$guest->points} pts.");
        }

        try {
            $result = $guest->redeemReward(
                itemTitle: $item['title'],
                pointsCost: $cost,
                itemDetail: $item['detail'],
                selectedOption: $validated['selected_option'] ?? null,
                notes: $validated['notes'] ?? null,
            );

            if ($request->wantsJson()) {
                return response()->json($result);
            }

            return redirect()->route('guest.points', [
                'name' => $guest->name,
                'phone' => $guest->phone,
                'slide' => 4,
            ])->with('redeem_success', [
                'voucher_code' => $result['voucher_code'],
                'item_title' => $item['title'],
                'item_detail' => $item['detail'],
                'selected_option' => $validated['selected_option'] ?? null,
                'points_cost' => $cost,
                'points_before' => $result['points_before'],
                'points_after' => $result['points_after'],
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Helper cari tamu berdasarkan Nama dan Nomor HP
     */
    private function queryGuestByBoth(string $name, string $phone): ?Guest
    {
        $cleanPhone = ltrim($phone, '+');
        $altPhone = str_starts_with($cleanPhone, '62') ? '0' . substr($cleanPhone, 2) : ('62' . ltrim($cleanPhone, '0'));

        return Guest::with([
            'stays' => fn($q) => $q->latest(),
            'redemptions' => fn($q) => $q->latest(),
        ])
            ->where('name', 'LIKE', '%' . $name . '%')
            ->where(function ($query) use ($phone, $cleanPhone, $altPhone) {
                $query->where('phone', 'LIKE', '%' . $phone . '%')
                      ->orWhere('phone', 'LIKE', '%' . $cleanPhone . '%')
                      ->orWhere('phone', 'LIKE', '%' . $altPhone . '%');
            })
            ->first();
    }

    /**
     * Helper cari tamu berdasarkan Nomor HP saja
     */
    private function queryGuestByPhone(string $phone): ?Guest
    {
        $cleanPhone = ltrim($phone, '+');
        $altPhone = str_starts_with($cleanPhone, '62') ? '0' . substr($cleanPhone, 2) : ('62' . ltrim($cleanPhone, '0'));

        return Guest::with([
            'stays' => fn($q) => $q->latest(),
            'redemptions' => fn($q) => $q->latest(),
        ])
            ->where(function ($query) use ($phone, $cleanPhone, $altPhone) {
                $query->where('phone', $phone)
                      ->orWhere('phone', $cleanPhone)
                      ->orWhere('phone', $altPhone)
                      ->orWhere('phone', 'LIKE', '%' . $cleanPhone . '%');
            })
            ->first();
    }

    /**
     * Helper cari tamu berdasarkan Nama saja
     */
    private function queryGuestByName(string $name): ?Guest
    {
        return Guest::with([
            'stays' => fn($q) => $q->latest(),
            'redemptions' => fn($q) => $q->latest(),
        ])
            ->where('name', 'LIKE', '%' . $name . '%')
            ->first();
    }
}
