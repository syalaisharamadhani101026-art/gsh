<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Stay;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Guest::count() > 0) {
            return;
        }

        // 1. Guest Silver: Budi Santoso (150 Poin)
        $guest1 = Guest::create([
            'member_number' => 'GSH-2610-0001',
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'tier' => 'Silver',
            'points' => 150,
        ]);
        Stay::create([
            'guest_id' => $guest1->id,
            'transaction_type' => 'room',
            'booking_code' => 'BK-1001',
            'room_type' => 'Grand Deluxe',
            'points_per_night' => 10,
            'nights' => 5,
            'revenue_amount' => null,
            'points_earned' => 50,
            'points_added' => 50,
            'stay_date' => now()->subDays(20)->toDateString(),
            'notes' => 'Direct booking online',
        ]);
        Stay::create([
            'guest_id' => $guest1->id,
            'transaction_type' => 'banquet',
            'booking_code' => 'EV-BNQ-1002',
            'room_type' => 'Rev Banquet',
            'points_per_night' => 10,
            'nights' => 1,
            'revenue_amount' => 10000000, // Rp 10.000.000 = 100 Poin
            'points_earned' => 100,
            'points_added' => 100,
            'stay_date' => now()->subDays(5)->toDateString(),
            'notes' => 'Event Seminar Bisnis di Ballroom GSH (Revenue Rp 10.000.000)',
        ]);

        // 2. Guest Gold: Siti Rahma (2.500 Poin)
        $guest2 = Guest::create([
            'member_number' => 'GSH-2610-0002',
            'name' => 'Siti Rahma',
            'phone' => '081987654321',
            'tier' => 'Gold',
            'points' => 2500,
        ]);
        Stay::create([
            'guest_id' => $guest2->id,
            'transaction_type' => 'room',
            'booking_code' => 'BK-2001',
            'room_type' => 'Royal Suite',
            'points_per_night' => 20,
            'nights' => 5,
            'revenue_amount' => null,
            'points_earned' => 100,
            'points_added' => 100,
            'stay_date' => now()->subDays(45)->toDateString(),
            'notes' => 'Family holiday stay',
        ]);
        Stay::create([
            'guest_id' => $guest2->id,
            'transaction_type' => 'banquet',
            'booking_code' => 'EV-BNQ-2002',
            'room_type' => 'Rev Banquet',
            'points_per_night' => 10,
            'nights' => 1,
            'revenue_amount' => 200000000, // Rp 200.000.000 = 2.000 Poin
            'points_earned' => 2000,
            'points_added' => 2000,
            'stay_date' => now()->subDays(15)->toDateString(),
            'notes' => 'Pernikahan Grand Ballroom (Revenue Rp 200.000.000)',
        ]);
        Stay::create([
            'guest_id' => $guest2->id,
            'transaction_type' => 'room',
            'booking_code' => 'BK-2003',
            'room_type' => 'President Suite',
            'points_per_night' => 30,
            'nights' => 4,
            'revenue_amount' => null,
            'points_earned' => 120,
            'points_added' => 120,
            'stay_date' => now()->subDays(3)->toDateString(),
            'notes' => 'VIP Gold Stay with Stasiun Tugu Pick-up',
        ]);

        // 3. Guest Platinum: Hendra Wijaya (7.800 Poin)
        $guest3 = Guest::create([
            'member_number' => 'GSH-2610-0003',
            'name' => 'Hendra Wijaya',
            'phone' => '081122334455',
            'tier' => 'Platinum',
            'points' => 7800,
        ]);
        Stay::create([
            'guest_id' => $guest3->id,
            'transaction_type' => 'banquet',
            'booking_code' => 'EV-BNQ-3001',
            'room_type' => 'Rev Banquet',
            'points_per_night' => 10,
            'nights' => 1,
            'revenue_amount' => 700000000, // Rp 700.000.000 = 7.000 Poin
            'points_earned' => 7000,
            'points_added' => 7000,
            'stay_date' => now()->subDays(60)->toDateString(),
            'notes' => 'Corporate National Gathering (Revenue Rp 700.000.000)',
        ]);
        Stay::create([
            'guest_id' => $guest3->id,
            'transaction_type' => 'room',
            'booking_code' => 'BK-3002',
            'room_type' => 'President Suite',
            'points_per_night' => 30,
            'nights' => 10,
            'revenue_amount' => null,
            'points_earned' => 300,
            'points_added' => 300,
            'stay_date' => now()->subDays(25)->toDateString(),
            'notes' => 'Executive long stay VIP treatment',
        ]);

        // 4. Guest Silver mendekati batas (980 Poin): Maya Sari
        $guest4 = Guest::create([
            'member_number' => 'GSH-2610-0004',
            'name' => 'Maya Sari',
            'phone' => '081333444555',
            'tier' => 'Silver',
            'points' => 980,
        ]);
        Stay::create([
            'guest_id' => $guest4->id,
            'transaction_type' => 'room',
            'booking_code' => 'BK-4001',
            'room_type' => 'Grand Executive',
            'points_per_night' => 15,
            'nights' => 4,
            'revenue_amount' => null,
            'points_earned' => 60,
            'points_added' => 60,
            'stay_date' => now()->subDays(10)->toDateString(),
            'notes' => 'Stay and dine',
        ]);
        Stay::create([
            'guest_id' => $guest4->id,
            'transaction_type' => 'banquet',
            'booking_code' => 'EV-BNQ-4002',
            'room_type' => 'Rev Banquet',
            'points_per_night' => 10,
            'nights' => 1,
            'revenue_amount' => 90000000, // Rp 90.000.000 = 900 Poin
            'points_earned' => 900,
            'points_added' => 900,
            'stay_date' => now()->subDays(1)->toDateString(),
            'notes' => 'Arisan & Gathering Keluarga (Revenue Rp 90.000.000)',
        ]);

        // 5. Sample Redemptions untuk demonstrasi
        \App\Models\Redemption::create([
            'guest_id' => $guest2->id,
            'voucher_code' => 'GSH-RDM-774901',
            'item_title' => 'Dining Voucher Rp 100.000',
            'item_category' => 500,
            'item_detail' => 'Voucher makan Lunch / Dinner senilai Rp 100.000,-',
            'selected_option' => null,
            'points_cost' => 500,
            'points_before' => 3000,
            'points_after' => 2500,
            'status' => 'aktif',
            'redeemed_at' => now()->subDays(2),
            'notes' => 'Tukar voucher F&B untuk makan malam di Restoran GSH',
        ]);

        \App\Models\Redemption::create([
            'guest_id' => $guest3->id,
            'voucher_code' => 'GSH-RDM-882194',
            'item_title' => 'Free 1 Night Stay Grand Deluxe',
            'item_category' => 1000,
            'item_detail' => 'Redeem 1 malam menginap gratis di Kamar Grand Deluxe',
            'selected_option' => null,
            'points_cost' => 1000,
            'points_before' => 8800,
            'points_after' => 7800,
            'status' => 'selesai',
            'redeemed_at' => now()->subDays(7),
            'notes' => 'Telah digunakan untuk menginap di Kamar 304',
        ]);
    }
}
