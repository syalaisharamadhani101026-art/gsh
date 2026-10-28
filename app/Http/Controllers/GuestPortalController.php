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
     * Halaman Web Customer Berbasis Mobile (Dedicated Mobile App Experience)
     */
    public function mobileIndex(Request $request)
    {
        $name = trim((string) $request->input('name'));
        $phone = preg_replace('/[^0-9+]/', '', (string) $request->input('phone'));
        $guestId = $request->input('guest_id');

        $guest = null;
        $searched = false;
        $notFound = false;

        // 1. Jika memilih langsung ID tamu (misal dari quick VIP switch di mobile)
        if (!empty($guestId)) {
            $guest = Guest::with([
                'stays' => fn($q) => $q->latest(),
                'redemptions' => fn($q) => $q->latest(),
            ])->find($guestId);

            if ($guest) {
                $searched = true;
                $name = $guest->name;
                $phone = $guest->phone;
            }
        } elseif ($request->has('name') || $request->has('phone')) {
            // 2. Pencarian berdasarkan Nama atau Nomor HP
            $searched = true;

            if (!empty($name) && !empty($phone)) {
                $guest = $this->queryGuestByBoth($name, $phone);
                if (!$guest) $guest = $this->queryGuestByPhone($phone);
                if (!$guest) $guest = $this->queryGuestByName($name);
            } elseif (!empty($phone)) {
                $guest = $this->queryGuestByPhone($phone);
            } elseif (!empty($name)) {
                $guest = $this->queryGuestByName($name);
            }

            if (!$guest) {
                $notFound = true;
            }
        }

        $sampleGuests = collect();

        // Hitung progres tier jika tamu ditemukan
        $tierProgress = null;
        if ($guest) {
            $currentTier = $guest->tier;
            $tierInfo = Guest::TIERS[$currentTier] ?? null;
            $nextTierName = $tierInfo['next_tier'] ?? null;
            $nextTierInfo = $nextTierName ? (Guest::TIERS[$nextTierName] ?? null) : null;

            $minPoints = $tierInfo['min_points'] ?? 0;
            $targetPoints = $nextTierInfo['min_points'] ?? 10000;
            $tierSpan = max(1, $targetPoints - $minPoints);
            $pointsInCurrentTier = max(0, $guest->points - $minPoints);

            $percent = $nextTierName ? min(100, round(($pointsInCurrentTier / $tierSpan) * 100)) : 100;
            $pointsNeeded = $nextTierName ? max(0, $targetPoints - $guest->points) : 0;

            $tierProgress = [
                'current_tier' => $currentTier,
                'next_tier' => $nextTierName,
                'current_points' => $guest->points,
                'tier_min' => $minPoints,
                'target_points' => $targetPoints,
                'percent' => $percent,
                'points_needed' => $pointsNeeded,
            ];
        }

        return view('guest.mobile', [
            'guest' => $guest,
            'searched' => $searched,
            'notFound' => $notFound,
            'searchName' => $name,
            'searchPhone' => $phone,
            'sampleGuests' => $sampleGuests,
            'tierProgress' => $tierProgress,
            'roomRates' => Guest::ROOM_RATES,
            'tiers' => Guest::TIERS,
            'redeemCatalog' => Guest::REDEEM_CATALOG,
            'banquetRevenuePerUnit' => Guest::BANQUET_REVENUE_PER_UNIT,
            'banquetPointsPerUnit' => Guest::BANQUET_POINTS_PER_UNIT,
            'activeTab' => $request->input('tab', 'home'),
        ]);
    }

    /**
     * Halaman Rekaman Layar Walkthrough Mobile Web Customer
     */
    public function screenRecording()
    {
        return view('guest.screen-recording');
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

            // Redirect khusus jika penukaran dari web customer mobile
            if ($request->input('source') === 'mobile' || ($request->header('referer') && str_contains($request->header('referer'), '/mobile'))) {
                return redirect()->route('guest.mobile', [
                    'guest_id' => $guest->id,
                    'tab' => 'riwayat',
                ])->with('redeem_success', [
                    'voucher_code' => $result['voucher_code'],
                    'item_title' => $item['title'],
                    'item_detail' => $item['detail'],
                    'selected_option' => $validated['selected_option'] ?? null,
                    'points_cost' => $cost,
                    'points_before' => $result['points_before'],
                    'points_after' => $result['points_after'],
                ]);
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
