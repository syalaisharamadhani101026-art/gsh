<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_number',
        'name',
        'phone',
        'tier',
        'points',
    ];

    /**
     * Nilai Poin Room per malam
     * Grand Deluxe    : 10
     * Grand Executive : 15
     * Royal Suite     : 20
     * President Suite : 30
     */
    public const ROOM_RATES = [
        'Grand Deluxe' => 10,
        'Grand Executive' => 15,
        'Royal Suite' => 20,
        'President Suite' => 30,
    ];

    /**
     * Nilai Poin dari Rev Banquet
     * Mendapatkan 10 Point dengan jumlah revenue per 1.000.000 dan berlaku untuk kelipatan
     */
    public const BANQUET_REVENUE_PER_UNIT = 1000000; // Rp 1.000.000
    public const BANQUET_POINTS_PER_UNIT = 10;       // 10 Poin

    /**
     * Tier rules, point caps, range, and full benefits
     * Silver   : 0 – 1000 Point
     * Gold     : 1000 – 5000 Point
     * Platinum : 5000 – 10.000 Point
     */
    public const TIERS = [
        'Silver' => [
            'name' => 'Silver',
            'min_points' => 0,
            'max_points' => 1000,
            'range_label' => '( 0 – 1,000 Points )',
            'reward' => '5% Discount on F&B',
            'reward_desc' => '5% Discount on F&B, IDR 10,000 Discount on Laundry & IDR 25,000 Discount on Room Rates for Direct Bookings.',
            'benefits' => [
                '5% Discount on F&B',
                'IDR 10,000 Discount on Laundry',
                'IDR 25,000 Discount on Room Rates for Direct Bookings',
            ],
            'next_tier' => 'Gold',
            'upgrade_threshold' => 1000,
            'color' => 'slate',
            'badge_class' => 'bg-slate-200 text-slate-900',
            'gradient' => 'from-slate-800 via-slate-900 to-zinc-950',
        ],
        'Gold' => [
            'name' => 'Gold',
            'min_points' => 1000,
            'max_points' => 5000,
            'range_label' => '( 1,000 – 5,000 Points )',
            'reward' => '10% Discount on F&B & Free Laundry',
            'reward_desc' => '10% Discount on F&B, Free Laundry for 3 Pieces, IDR 50,000 Direct Booking Discount, Shuttle Tugu & VIP Privileges.',
            'benefits' => [
                '10% Discount on F&B',
                'Free Laundry for 3 Pieces (1 Top, 1 Bottom, and 1 Undergarment)',
                'IDR 50,000 Discount on Room Rates for Direct Bookings',
                'Early Check-in & Late Check-out Privileges',
                'Complimentary Pick-up & Drop-off at Tugu Train Station',
                'Complimentary Room Upgrade (Subject to Availability)',
                'Complimentary E-Bike for 1 Hour (1 Person)',
                'VIP Treatment',
            ],
            'next_tier' => 'Platinum',
            'upgrade_threshold' => 5000,
            'color' => 'amber',
            'badge_class' => 'bg-amber-500 text-slate-950',
            'gradient' => 'from-[#1a1409] via-[#2f2310] to-[#120d05]',
        ],
        'Platinum' => [
            'name' => 'Platinum',
            'min_points' => 5000,
            'max_points' => 10000,
            'range_label' => '( 5,000 – 10,000 Points )',
            'reward' => 'Free 1 Night Stay & 15% Discount',
            'reward_desc' => 'Free Complimentary Room for 1 Night Stay Annually, 15% Discount on F&B, Free Laundry 5 Pieces & Wheel of Fortune Entry.',
            'benefits' => [
                'Free Complimentary Room for 1 Night Stay Annually',
                '15% Discount on F&B',
                'Free Laundry for 5 Pieces (1 Top, 1 Bottom, and 3 Undergarments)',
                'IDR 100,000 Discount on Room Rates for Direct Bookings',
                'Early Check-in & Late Check-out Privileges',
                'Complimentary Pick-up & Drop-off at Tugu Train Station',
                'Complimentary Room Upgrade (Subject to Availability)',
                'Complimentary E-Bike for 1 Hour (Up to 2 Persons)',
                'Complimentary Birthday Cake',
                'VIP Treatment',
                'Special Gift',
                'One Complimentary Room Night Annually',
            ],
            'next_tier' => null,
            'upgrade_threshold' => null,
            'color' => 'indigo',
            'badge_class' => 'bg-indigo-400 text-slate-950',
            'gradient' => 'from-[#0c0d15] via-[#1b1e33] to-[#0a0b12]',
        ],
    ];

    /**
     * Katalog Penukaran Poin (Redeem Point)
     */
    public const REDEEM_CATALOG = [
        100 => [
            'points' => 100,
            'label' => '100 Point',
            'items' => [
                [
                    'id' => 'souvenir-100',
                    'title' => 'GSH Souvenir Package',
                    'detail' => 'Black Pouch, Notepad, Executive Pen',
                    'badge' => 'Includes 3 Items',
                    'icon' => 'package',
                    'options' => [],
                ],
                [
                    'id' => 'ebike-100',
                    'title' => 'E-Bike Rental (1 Jam)',
                    'detail' => 'Electric bicycle rental for 1 person for 1 hour',
                    'badge' => 'Outdoor Activity',
                    'icon' => 'bike',
                    'options' => [],
                ],
                [
                    'id' => 'dining-75',
                    'title' => 'Dining Voucher Rp 75.000',
                    'detail' => 'Dining voucher for Lunch or Dinner worth IDR 75,000',
                    'badge' => 'F&B Dining',
                    'icon' => 'utensils',
                    'options' => [],
                ],
            ],
        ],
        500 => [
            'points' => 500,
            'label' => '500 Point',
            'items' => [
                [
                    'id' => 'merchandise-500',
                    'title' => 'Premium GSH Souvenir',
                    'detail' => 'Umbrella / Portable Fan / Leather Pouch / Mug & Tumbler (Choose one)',
                    'badge' => 'Choose One Option',
                    'icon' => 'gift',
                    'options' => [
                        'Payung Exclusive GSH',
                        'Kipas Portable GSH',
                        'Pouch Kulit GSH',
                        'Mug & Tumbler GSH',
                    ],
                ],
                [
                    'id' => 'dining-100',
                    'title' => 'Dining Voucher Rp 100.000',
                    'detail' => 'Dining voucher for Lunch or Dinner worth IDR 100,000',
                    'badge' => 'F&B Dining',
                    'icon' => 'utensils',
                    'options' => [],
                ],
            ],
        ],
        1000 => [
            'points' => 1000,
            'label' => '1.000 Point',
            'items' => [
                [
                    'id' => 'stay-1000',
                    'title' => 'Free 1 Night Stay Grand Deluxe',
                    'detail' => 'Redeem 1 complimentary night stay in a Grand Deluxe Room',
                    'badge' => 'Free Stay Voucher',
                    'icon' => 'bed-double',
                    'options' => [],
                ],
            ],
        ],
    ];

    /**
     * Cari detail item redeem berdasarkan ID
     */
    public static function findRedeemItem(string $itemId): ?array
    {
        foreach (self::REDEEM_CATALOG as $cost => $category) {
            foreach ($category['items'] as $item) {
                if ($item['id'] === $itemId) {
                    $item['points_cost'] = $cost;
                    return $item;
                }
            }
        }
        return null;
    }

    /**
     * Relasi ke riwayat penukaran hadiah (Redemptions)
     */
    public function redemptions(): HasMany
    {
        return $this->hasMany(Redemption::class)->latest();
    }

    /**
     * Relasi ke riwayat menginap / transaksi poin
     */
    public function stays(): HasMany
    {
        return $this->hasMany(Stay::class)->latest();
    }

    /**
     * Dapatkan data config tier saat ini
     */
    public function getTierConfigAttribute(): array
    {
        return self::TIERS[$this->tier] ?? self::TIERS['Silver'];
    }

    /**
     * Batas maksimal poin untuk tier tamu
     */
    public function getMaxPointsAttribute(): ?int
    {
        return $this->tier_config['max_points'] ?? 1000;
    }

    /**
     * Reward highlight yang bisa didapat
     */
    public function getRewardAttribute(): string
    {
        return $this->tier_config['reward'];
    }

    /**
     * Deskripsi reward
     */
    public function getRewardDescriptionAttribute(): string
    {
        return $this->tier_config['reward_desc'];
    }

    /**
     * Seluruh daftar benefit sesuai tier tamu
     */
    public function getBenefitsAttribute(): array
    {
        return $this->tier_config['benefits'] ?? [];
    }

    /**
     * Persentase poin terhadap batas maksimal
     */
    public function getPointsPercentageAttribute(): int
    {
        $max = $this->max_points ?: 10000;
        return (int) min(100, round(($this->points / $max) * 100));
    }

    /**
     * Hitung poin dari Revenue Banquet (10 Poin per Rp 1.000.000 kelipatan)
     */
    public static function calculateBanquetPoints(int|float $revenue): int
    {
        if ($revenue <= 0) {
            return 0;
        }
        return (int) (floor($revenue / self::BANQUET_REVENUE_PER_UNIT) * self::BANQUET_POINTS_PER_UNIT);
    }

    /**
     * Generate nomor member otomatis
     * Format: GSH-YYMM-XXXX (contoh: GSH-2610-0001)
     */
    public static function generateMemberNumber(): string
    {
        $prefix = 'GSH-' . date('ym') . '-';
        $latest = self::where('member_number', 'LIKE', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($latest) {
            $lastNumber = (int) substr($latest->member_number, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Helper umum penerapan akumulasi poin dan pembatasan maksimal tier
     */
    protected function calculatePointAccumulation(int $pointsEarned, bool $allowAutoPromote): array
    {
        $pointsBefore = $this->points;
        $tierBefore = $this->tier;
        $maxPoints = $this->max_points;

        $newTotal = $pointsBefore + $pointsEarned;
        $tierUpgraded = false;
        $cappedInfo = null;

        if ($maxPoints !== null && $newTotal > $maxPoints) {
            if ($allowAutoPromote && !empty($this->tier_config['next_tier'])) {
                // Naikkan ke tier berikutnya jika auto-promote aktif
                $newTier = $this->tier_config['next_tier'];
                $this->tier = $newTier;
                $newMax = self::TIERS[$newTier]['max_points'];

                if ($newMax !== null && $newTotal > $newMax) {
                    $pointsAdded = max(0, $newMax - $pointsBefore);
                    $this->points = $newMax;
                    $diff = $newTotal - $newMax;
                    $cappedInfo = "Poin mencapai batas maksimal {$newMax} poin untuk tier {$newTier}. Sisa {$diff} poin terpotong.";
                } else {
                    $pointsAdded = $pointsEarned;
                    $this->points = $newTotal;
                }
                $tierUpgraded = true;
            } else {
                // Terapkan batas maksimal tier saat ini (Silver: 1000, Gold: 5000, Platinum: 10000)
                $pointsAdded = max(0, $maxPoints - $pointsBefore);
                $this->points = $maxPoints;
                $diff = $newTotal - $maxPoints;
                $cappedInfo = "Poin mencapai batas maksimal {$maxPoints} poin untuk tier {$this->tier}. Sisa {$diff} poin tidak dapat ditambahkan.";
            }
        } else {
            $pointsAdded = $pointsEarned;
            $this->points = $newTotal;
        }

        $this->save();

        return [
            'points_earned' => $pointsEarned,
            'points_added' => $pointsAdded,
            'points_before' => $pointsBefore,
            'points_after' => $this->points,
            'tier_before' => $tierBefore,
            'tier_after' => $this->tier,
            'is_capped' => !is_null($cappedInfo),
            'capped_message' => $cappedInfo,
            'tier_upgraded' => $tierUpgraded,
        ];
    }

    /**
     * Tambah stay kamar dan kalkulasi poin dengan batasan maksimal tier
     */
    public function recordStay(
        string $bookingCode,
        string $roomType,
        int $nights,
        ?string $stayDate = null,
        ?string $notes = null,
        bool $allowAutoPromote = false
    ): array {
        $pointsPerNight = self::ROOM_RATES[$roomType] ?? 10;
        $pointsEarned = $pointsPerNight * $nights;

        $calc = $this->calculatePointAccumulation($pointsEarned, $allowAutoPromote);

        // Buat record riwayat menginap kamar
        $stay = $this->stays()->create([
            'transaction_type' => 'room',
            'booking_code' => $bookingCode,
            'room_type' => $roomType,
            'points_per_night' => $pointsPerNight,
            'nights' => $nights,
            'revenue_amount' => null,
            'points_earned' => $pointsEarned,
            'points_added' => $calc['points_added'],
            'stay_date' => $stayDate ?: now()->toDateString(),
            'notes' => $notes ?: $calc['capped_message'],
        ]);

        $calc['stay'] = $stay;
        return $calc;
    }

    /**
     * Tambah transaksi Banquet Revenue (10 poin per kelipatan Rp 1.000.000)
     */
    public function recordBanquet(
        string $invoiceCode,
        int $revenueAmount,
        ?string $eventDate = null,
        ?string $notes = null,
        bool $allowAutoPromote = false
    ): array {
        $pointsEarned = self::calculateBanquetPoints($revenueAmount);

        $calc = $this->calculatePointAccumulation($pointsEarned, $allowAutoPromote);

        // Buat record transaksi banquet
        $stay = $this->stays()->create([
            'transaction_type' => 'banquet',
            'booking_code' => $invoiceCode,
            'room_type' => 'Rev Banquet',
            'points_per_night' => 10,
            'nights' => 1,
            'revenue_amount' => $revenueAmount,
            'points_earned' => $pointsEarned,
            'points_added' => $calc['points_added'],
            'stay_date' => $eventDate ?: now()->toDateString(),
            'notes' => $notes ?: ($calc['capped_message'] ?: 'Revenue Banquet Rp ' . number_format($revenueAmount, 0, ',', '.')),
        ]);

        $calc['stay'] = $stay;
        return $calc;
    }

    /**
     * Tukar poin dengan reward pilihan
     */
    public function redeemReward(
        string $itemTitle,
        int $pointsCost,
        ?string $itemDetail = null,
        ?string $selectedOption = null,
        ?string $notes = null
    ): array {
        if ($this->points < $pointsCost) {
            throw new \InvalidArgumentException("Poin Anda tidak mencukupi untuk menukar item ini. Poin saat ini: {$this->points}, dibutuhkan: {$pointsCost}.");
        }

        $pointsBefore = $this->points;
        $pointsAfter = $pointsBefore - $pointsCost;

        $this->points = $pointsAfter;
        $this->save();

        $voucherCode = Redemption::generateVoucherCode();

        $redemption = $this->redemptions()->create([
            'voucher_code' => $voucherCode,
            'item_title' => $itemTitle,
            'item_category' => $pointsCost,
            'item_detail' => $itemDetail,
            'selected_option' => $selectedOption,
            'points_cost' => $pointsCost,
            'points_before' => $pointsBefore,
            'points_after' => $pointsAfter,
            'status' => 'aktif',
            'redeemed_at' => now(),
            'notes' => $notes,
        ]);

        return [
            'success' => true,
            'redemption' => $redemption,
            'voucher_code' => $voucherCode,
            'points_cost' => $pointsCost,
            'points_before' => $pointsBefore,
            'points_after' => $pointsAfter,
            'message' => "Penukaran {$itemTitle} berhasil! Kode voucher Anda: {$voucherCode}",
        ];
    }
}
