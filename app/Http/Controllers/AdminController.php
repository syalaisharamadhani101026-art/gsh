<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Redemption;
use App\Models\Stay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Tampilan utama halaman Admin
     */
    public function index(Request $request): View
    {
        $search = $request->query('q');

        $guestsQuery = Guest::withCount('stays')->latest();
        if (!empty($search)) {
            $guestsQuery->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('member_number', 'LIKE', "%{$search}%");
            });
        }
        $guests = $guestsQuery->paginate(10)->withQueryString();

        $recentStays = Stay::with('guest')->latest()->take(15)->get();
        $recentRedemptions = Redemption::with('guest')->latest()->take(15)->get();

        // Statistik ringkasan
        $stats = [
            'total_guests' => Guest::count(),
            'silver_guests' => Guest::where('tier', 'Silver')->count(),
            'gold_guests' => Guest::where('tier', 'Gold')->count(),
            'platinum_guests' => Guest::where('tier', 'Platinum')->count(),
            'total_stays' => Stay::count(),
            'total_points_distributed' => Stay::sum('points_added'),
            'total_redemptions' => Redemption::count(),
            'total_points_redeemed' => (int) Redemption::sum('points_cost'),
        ];

        // Preview nomor member baru berikutnya
        $nextMemberNumber = Guest::generateMemberNumber();

        return view('admin.dashboard', [
            'guests' => $guests,
            'recentStays' => $recentStays,
            'recentRedemptions' => $recentRedemptions,
            'stats' => $stats,
            'roomRates' => Guest::ROOM_RATES,
            'banquetRevenuePerUnit' => Guest::BANQUET_REVENUE_PER_UNIT,
            'banquetPointsPerUnit' => Guest::BANQUET_POINTS_PER_UNIT,
            'tiers' => Guest::TIERS,
            'redeemCatalog' => Guest::REDEEM_CATALOG,
            'nextMemberNumber' => $nextMemberNumber,
            'searchQuery' => $search,
        ]);
    }

    /**
     * Simpan data transaksi menginap kamar ATAU revenue banquet dan hitung poin tamu
     */
    public function storeStay(Request $request): RedirectResponse
    {
        $transactionType = $request->input('transaction_type', 'room');

        $rules = [
            'transaction_type' => 'nullable|in:room,banquet',
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:50',
            'booking_code' => 'required|string|max:50|unique:stays,booking_code',
            'stay_date' => 'nullable|date',
            'notes' => 'nullable|string|max:255',
            'auto_upgrade' => 'nullable|boolean',
        ];

        if ($transactionType === 'banquet') {
            $rules['revenue_amount'] = 'required|numeric|min:1000000';
        } else {
            $rules['room_type'] = 'required|in:Grand Deluxe,Grand Executive,Royal Suite,President Suite';
            $rules['nights'] = 'required|integer|min:1|max:365';
        }

        $validated = $request->validate($rules, [
            'name.required' => 'Nama tamu wajib diisi.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'booking_code.required' => 'Kode booking / invoice event wajib diisi.',
            'booking_code.unique' => 'Kode booking / invoice sudah pernah digunakan.',
            'room_type.required' => 'Pilih tipe kamar.',
            'room_type.in' => 'Tipe kamar tidak valid.',
            'nights.required' => 'Jumlah malam wajib diisi.',
            'revenue_amount.required' => 'Nominal revenue banquet wajib diisi.',
            'revenue_amount.min' => 'Nominal revenue banquet minimal Rp 1.000.000 untuk mendapatkan poin.',
        ]);

        $phone = preg_replace('/[^0-9+]/', '', $validated['phone']);
        $name = trim($validated['name']);

        // Cari tamu berdasarkan nomor HP (atau nama)
        $cleanPhone = ltrim($phone, '+');
        $altPhone = str_starts_with($cleanPhone, '62') ? '0' . substr($cleanPhone, 2) : ('62' . ltrim($cleanPhone, '0'));

        $guest = Guest::where(function ($q) use ($phone, $cleanPhone, $altPhone) {
            $q->where('phone', $phone)
              ->orWhere('phone', $cleanPhone)
              ->orWhere('phone', $altPhone);
        })->first();

        $isNewGuest = false;

        if (!$guest) {
            // Tamu baru: Buat nomor member otomatis
            $isNewGuest = true;
            $memberNumber = Guest::generateMemberNumber();

            $guest = Guest::create([
                'member_number' => $memberNumber,
                'name' => $name,
                'phone' => $phone,
                'tier' => 'Silver',
                'points' => 0,
            ]);
        } else {
            // Update nama jika ada koreksi
            if (!empty($name) && $guest->name !== $name) {
                $guest->name = $name;
                $guest->save();
            }
        }

        $allowAutoPromote = $request->boolean('auto_upgrade');

        // Jalankan kalkulasi poin sesuai tipe transaksi
        if ($transactionType === 'banquet') {
            $result = $guest->recordBanquet(
                invoiceCode: strtoupper(trim($validated['booking_code'])),
                revenueAmount: (int) $validated['revenue_amount'],
                eventDate: $validated['stay_date'] ?? null,
                notes: $validated['notes'] ?? null,
                allowAutoPromote: $allowAutoPromote
            );
        } else {
            $result = $guest->recordStay(
                bookingCode: strtoupper(trim($validated['booking_code'])),
                roomType: $validated['room_type'],
                nights: (int) $validated['nights'],
                stayDate: $validated['stay_date'] ?? null,
                notes: $validated['notes'] ?? null,
                allowAutoPromote: $allowAutoPromote
            );
        }

        $flashData = [
            'guest_name' => $guest->name,
            'member_number' => $guest->member_number,
            'is_new_guest' => $isNewGuest,
            'transaction_type' => $transactionType,
            'room_type' => $transactionType === 'banquet' ? 'Rev Banquet' : $validated['room_type'],
            'nights' => $transactionType === 'banquet' ? 1 : (int) $validated['nights'],
            'revenue_amount' => $transactionType === 'banquet' ? (int) $validated['revenue_amount'] : null,
            'points_earned' => $result['points_earned'],
            'points_added' => $result['points_added'],
            'points_before' => $result['points_before'],
            'points_after' => $result['points_after'],
            'tier_before' => $result['tier_before'],
            'tier_after' => $result['tier_after'],
            'is_capped' => $result['is_capped'],
            'capped_message' => $result['capped_message'],
            'tier_upgraded' => $result['tier_upgraded'],
        ];

        $successMsg = $transactionType === 'banquet' 
            ? "Transaksi Revenue Banquet berhasil disimpan! +{$result['points_added']} poin masuk ke akun tamu."
            : "Pencatatan menginap berhasil disimpan! +{$result['points_added']} poin masuk ke akun tamu.";

        return redirect()->route('admin.dashboard')
            ->with('success', $successMsg)
            ->with('stay_result', $flashData);
    }

    /**
     * Upgrade tingkat member secara manual oleh admin
     */
    public function upgradeTier(Request $request, Guest $guest): RedirectResponse
    {
        $validated = $request->validate([
            'tier' => 'required|in:Silver,Gold,Platinum',
        ]);

        $oldTier = $guest->tier;
        $guest->tier = $validated['tier'];

        // Jika diubah ke tier dengan batas lebih kecil dari poin saat ini, terapkan batas
        $newMax = Guest::TIERS[$guest->tier]['max_points'];
        if ($newMax !== null && $guest->points > $newMax) {
            $guest->points = $newMax;
        }

        $guest->save();

        return redirect()->back()->with('success', "Tier tamu {$guest->name} berhasil diubah dari {$oldTier} menjadi {$guest->tier}.");
    }

    /**
     * API lookup tamu untuk autofill cepat di form admin
     */
    public function lookup(Request $request): JsonResponse
    {
        $query = trim((string) $request->input('query'));
        $phoneParam = trim((string) $request->input('phone'));
        $nameParam = trim((string) $request->input('name'));

        if (empty($query) && empty($phoneParam) && empty($nameParam)) {
            return response()->json([
                'found' => false,
                'next_member_number' => Guest::generateMemberNumber(),
            ]);
        }

        $guest = null;

        // 1. Jika nomor HP diberikan, cari berdasarkan nomor HP
        $phoneQuery = $phoneParam ?: (preg_match('/[0-9]{4,}/', $query) ? $query : '');
        if (!empty($phoneQuery)) {
            $cleanPhone = preg_replace('/[^0-9+]/', '', $phoneQuery);
            if (strlen($cleanPhone) >= 4) {
                $cleanDigits = ltrim($cleanPhone, '+');
                $altPhone = str_starts_with($cleanDigits, '62') ? '0' . substr($cleanDigits, 2) : ('62' . ltrim($cleanDigits, '0'));

                $guest = Guest::where(function ($q) use ($cleanPhone, $cleanDigits, $altPhone) {
                    $q->where('phone', $cleanPhone)
                      ->orWhere('phone', $cleanDigits)
                      ->orWhere('phone', $altPhone)
                      ->orWhere('phone', 'LIKE', "%{$cleanDigits}%");
                })->first();
            }
        }

        // 2. Jika belum ketemu, cari berdasarkan Nama Lengkap atau Nomor Member
        if (!$guest) {
            $nameQuery = $nameParam ?: $query;
            if (strlen($nameQuery) >= 3) {
                $guest = Guest::where('name', 'LIKE', "%{$nameQuery}%")
                    ->orWhere('member_number', 'LIKE', "%{$nameQuery}%")
                    ->first();
            }
        }

        if ($guest) {
            return response()->json([
                'found' => true,
                'guest' => [
                    'id' => $guest->id,
                    'name' => $guest->name,
                    'phone' => $guest->phone,
                    'member_number' => $guest->member_number,
                    'tier' => $guest->tier,
                    'points' => (int) $guest->points,
                    'max_points' => $guest->max_points,
                    'reward' => $guest->reward,
                ]
            ]);
        }

        return response()->json([
            'found' => false,
            'next_member_number' => Guest::generateMemberNumber(),
        ]);
    }

    /**
     * Update status voucher penukaran hadiah (misal: aktif -> selesai)
     */
    public function updateRedemptionStatus(Request $request, Redemption $redemption): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:aktif,selesai,batal',
        ]);

        $redemption->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', "Status voucher {$redemption->voucher_code} berhasil diubah menjadi: " . strtoupper($validated['status']));
    }

    /**
     * Admin memproses penukaran poin langsung di meja resepsionis
     */
    public function storeRedemption(Request $request): RedirectResponse
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
            return back()->with('error', 'Item penukaran hadiah tidak ditemukan.');
        }

        $cost = $item['points_cost'];

        if ($guest->points < $cost) {
            return back()->with('error', "Poin tamu tidak mencukupi untuk menukar {$item['title']}. Dibutuhkan {$cost} poin, saldo tamu: {$guest->points} poin.");
        }

        try {
            $result = $guest->redeemReward(
                itemTitle: $item['title'],
                pointsCost: $cost,
                itemDetail: $item['detail'],
                selectedOption: $validated['selected_option'] ?? null,
                notes: $validated['notes'] ?: 'Ditukar langsung di Resepsionis Hotel',
            );

            return back()->with('success', "Penukaran {$item['title']} untuk tamu {$guest->name} berhasil! Kode Voucher: {$result['voucher_code']}");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
