<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\Stay;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HotelLoyaltyTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::create([
            'name' => 'Front Desk Admin',
            'email' => 'admin@grandsenyum.com',
            'password' => Hash::make('admin123'),
        ]);
    }

    /**
     * Test room rate points calculation:
     * Grand Deluxe    : 10
     * Grand Executive : 15
     * Royal Suite     : 20
     * President Suite : 30
     */
    public function test_room_rate_points_calculation(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-0010',
            'name' => 'Testing Guest',
            'phone' => '089999999999',
            'tier' => 'Platinum',
            'points' => 0,
        ]);

        // Grand Deluxe: 10 pts/night x 2 = 20
        $resDeluxe = $guest->recordStay('BK-TEST-1', 'Grand Deluxe', 2);
        $this->assertEquals(20, $resDeluxe['points_earned']);
        $this->assertEquals(20, $resDeluxe['points_after']);

        // Grand Executive: 15 pts/night x 2 = 30
        $resExec = $guest->recordStay('BK-TEST-2', 'Grand Executive', 2);
        $this->assertEquals(30, $resExec['points_earned']);
        $this->assertEquals(50, $resExec['points_after']);

        // Royal Suite: 20 pts/night x 2 = 40
        $resRoyal = $guest->recordStay('BK-TEST-3', 'Royal Suite', 2);
        $this->assertEquals(40, $resRoyal['points_earned']);
        $this->assertEquals(90, $resRoyal['points_after']);

        // President Suite: 30 pts/night x 3 = 90
        $resPresident = $guest->recordStay('BK-TEST-4', 'President Suite', 3);
        $this->assertEquals(90, $resPresident['points_earned']);
        $this->assertEquals(180, $resPresident['points_after']);
    }

    /**
     * Test banquet revenue points calculation (10 pts per Rp 1.000.000)
     */
    public function test_banquet_revenue_points_calculation(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-0015',
            'name' => 'Banquet Organizer',
            'phone' => '087711223344',
            'tier' => 'Platinum',
            'points' => 0,
        ]);

        // Rp 10.000.000 = 100 pts
        $res1 = $guest->recordBanquet('EV-100', 10000000);
        $this->assertEquals(100, $res1['points_earned']);
        $this->assertEquals(100, $res1['points_after']);

        // Rp 2.500.000 = 20 pts (kelipatan 1.000.000)
        $res2 = $guest->recordBanquet('EV-200', 2500000);
        $this->assertEquals(20, $res2['points_earned']);
        $this->assertEquals(120, $res2['points_after']);
    }

    /**
     * Test Silver tier point cap (max 1.000)
     */
    public function test_silver_tier_points_capped_at_1000(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-0020',
            'name' => 'Silver Guest Cap Test',
            'phone' => '087777777777',
            'tier' => 'Silver',
            'points' => 950,
        ]);

        // President Suite: 30 pts/night x 3 = 90 pts.
        // Potential: 950 + 90 = 1040. Silver cap = 1.000!
        $res = $guest->recordStay('BK-SILVER-CAP', 'President Suite', 3, allowAutoPromote: false);

        $this->assertEquals(90, $res['points_earned']);
        $this->assertEquals(50, $res['points_added']);
        $this->assertEquals(1000, $res['points_after']);
        $this->assertTrue($res['is_capped']);

        $guest->refresh();
        $this->assertEquals(1000, $guest->points);
    }

    /**
     * Test Gold tier point cap (max 5.000)
     */
    public function test_gold_tier_points_capped_at_5000(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-0030',
            'name' => 'Gold Guest Cap Test',
            'phone' => '088888888888',
            'tier' => 'Gold',
            'points' => 4950,
        ]);

        // Banquet Event Rp 20.000.000 = 200 pts.
        // Potential: 4950 + 200 = 5150. Gold cap = 5.000!
        $res = $guest->recordBanquet('EV-GOLD-CAP', 20000000, allowAutoPromote: false);

        $this->assertEquals(200, $res['points_earned']);
        $this->assertEquals(50, $res['points_added']);
        $this->assertEquals(5000, $res['points_after']);
        $this->assertTrue($res['is_capped']);

        $guest->refresh();
        $this->assertEquals(5000, $guest->points);
    }

    /**
     * Test Platinum tier point cap (max 10.000)
     */
    public function test_platinum_tier_points_capped_at_10000(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-0040',
            'name' => 'Platinum VIP Test',
            'phone' => '089911223344',
            'tier' => 'Platinum',
            'points' => 9900,
        ]);

        // Banquet Event Rp 30.000.000 = 300 pts.
        // Potential: 9900 + 300 = 10200. Platinum cap = 10.000!
        $res = $guest->recordBanquet('EV-PLAT-CAP', 30000000, allowAutoPromote: false);

        $this->assertEquals(300, $res['points_earned']);
        $this->assertEquals(100, $res['points_added']);
        $this->assertEquals(10000, $res['points_after']);
        $this->assertTrue($res['is_capped']);

        $guest->refresh();
        $this->assertEquals(10000, $guest->points);
    }

    /**
     * Test benefits checklist by tier
     */
    public function test_benefits_matched_by_tier(): void
    {
        $silver = new Guest(['tier' => 'Silver']);
        $this->assertContains('Discount F&B 5%', $silver->benefits);

        $gold = new Guest(['tier' => 'Gold']);
        $this->assertContains('Discount F&B 10%', $gold->benefits);
        $this->assertContains('Discount room Rp 25.000 by Direct booking', $gold->benefits);
        $this->assertContains('Free E-bike 1 hour (1 pax)', $gold->benefits);

        $platinum = new Guest(['tier' => 'Platinum']);
        $this->assertContains('Discount F&B 15%', $platinum->benefits);
        $this->assertContains('Discount room Rp 100.000 by Direct booking', $platinum->benefits);
        $this->assertContains('Free Complimentary room for 1 night stay annually', $platinum->benefits);
    }

    /**
     * Test Admin form creates new guest and records room stay
     */
    public function test_admin_stores_stay_and_creates_new_guest_automatically(): void
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.stay.store'), [
            'transaction_type' => 'room',
            'name' => 'Ahmad Baru',
            'phone' => '085512345678',
            'booking_code' => 'BK-AHMAD-01',
            'room_type' => 'Grand Deluxe',
            'nights' => 3,
            'stay_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('guests', [
            'name' => 'Ahmad Baru',
            'phone' => '085512345678',
            'tier' => 'Silver',
            'points' => 30, // 3 x 10
        ]);

        $guest = Guest::where('phone', '085512345678')->first();
        $this->assertNotNull($guest->member_number);
        $this->assertStringStartsWith('GSH-', $guest->member_number);

        $this->assertDatabaseHas('stays', [
            'guest_id' => $guest->id,
            'booking_code' => 'BK-AHMAD-01',
            'room_type' => 'Grand Deluxe',
            'nights' => 3,
            'points_earned' => 30,
            'points_added' => 30,
        ]);
    }

    /**
     * Test Admin form stores banquet revenue transaction
     */
    public function test_admin_stores_banquet_transaction(): void
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.stay.store'), [
            'transaction_type' => 'banquet',
            'name' => 'PT Maju Bersama',
            'phone' => '081288776655',
            'booking_code' => 'INV-BNQ-99',
            'revenue_amount' => 50000000, // Rp 50.000.000 = 500 Poin
            'stay_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('stays', [
            'booking_code' => 'INV-BNQ-99',
            'transaction_type' => 'banquet',
            'revenue_amount' => 50000000,
            'points_earned' => 500,
            'points_added' => 500,
        ]);
    }

    /**
     * Test Guest check points portal without login
     */
    public function test_guest_portal_points_check(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-9999',
            'name' => 'Rina Kartika',
            'phone' => '081299998888',
            'tier' => 'Gold',
            'points' => 2500,
        ]);

        Stay::create([
            'guest_id' => $guest->id,
            'transaction_type' => 'room',
            'booking_code' => 'BK-RINA-01',
            'room_type' => 'Grand Executive',
            'points_per_night' => 15,
            'nights' => 4,
            'points_earned' => 60,
            'points_added' => 60,
            'stay_date' => now()->toDateString(),
        ]);

        $response = $this->get(route('guest.points', [
            'name' => 'Rina Kartika',
            'phone' => '081299998888',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Rina Kartika');
        $response->assertSee('GSH-2610-9999');
        $response->assertSee('BK-RINA-01');

        // Test cari berdasarkan NAMA saja
        $respName = $this->get(route('guest.points', ['name' => 'Rina Kartika']));
        $respName->assertStatus(200);
        $respName->assertSee('Rina Kartika');

        // Test cari berdasarkan NOMOR HP saja
        $respPhone = $this->get(route('guest.points', ['phone' => '081299998888']));
        $respPhone->assertStatus(200);
        $respPhone->assertSee('Rina Kartika');
    }

    /**
     * Test Admin dashboard loads successfully
     */
    public function test_admin_dashboard_renders_successfully(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Pencatatan Reservasi & Poin Tamu', false);
    }

    /**
     * Test guest can redeem points successfully
     */
    public function test_guest_can_redeem_points_successfully(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-8888',
            'name' => 'Dimas Anggara',
            'phone' => '081288887777',
            'tier' => 'Gold',
            'points' => 1500,
        ]);

        $response = $this->post(route('guest.redeem'), [
            'guest_id' => $guest->id,
            'item_id' => 'souvenir-100',
            'notes' => 'Tukar paket souvenir',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('redeem_success');

        $guest->refresh();
        $this->assertEquals(1400, $guest->points); // 1500 - 100 = 1400
        $this->assertDatabaseHas('redemptions', [
            'guest_id' => $guest->id,
            'item_title' => 'Paket Souvenir GSH',
            'points_cost' => 100,
            'points_before' => 1500,
            'points_after' => 1400,
            'status' => 'aktif',
        ]);
    }

    /**
     * Test guest cannot redeem points if balance is insufficient
     */
    public function test_guest_cannot_redeem_points_if_insufficient(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-7777',
            'name' => 'Doni Pratama',
            'phone' => '081277776666',
            'tier' => 'Silver',
            'points' => 50, // Kurang dari 100
        ]);

        $response = $this->post(route('guest.redeem'), [
            'guest_id' => $guest->id,
            'item_id' => 'souvenir-100',
        ]);

        $response->assertSessionHas('error');
        $guest->refresh();
        $this->assertEquals(50, $guest->points); // Poin tidak berkurang
        $this->assertEquals(0, $guest->redemptions()->count());
    }

    /**
     * Test admin can update redemption status
     */
    public function test_admin_can_update_redemption_status(): void
    {
        $guest = Guest::create([
            'member_number' => 'GSH-2610-6666',
            'name' => 'Rina Melati',
            'phone' => '081266665555',
            'tier' => 'Gold',
            'points' => 2000,
        ]);

        $result = $guest->redeemReward('Dining Voucher Rp 100.000', 500);
        $redemption = $result['redemption'];

        $this->assertEquals('aktif', $redemption->status);

        $response = $this->actingAs($this->adminUser)->post(route('admin.redemption.status', $redemption), [
            'status' => 'selesai',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $redemption->refresh();
        $this->assertEquals('selesai', $redemption->status);
    }

    /**
     * Test tamu/customer tanpa login tidak bisa mengakses dashboard admin
     */
    public function test_unauthenticated_customer_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test admin dapat login dengan kredensial yang valid
     */
    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'login' => 'admin@grandsenyum.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->adminUser);
    }

    /**
     * Test portal customer tidak menampilkan tombol atau tautan ke Halaman Admin
     */
    public function test_customer_portal_does_not_contain_admin_button(): void
    {
        $response = $this->get(route('guest.points'));
        $response->assertStatus(200);
        $response->assertDontSee('Halaman Admin');
    }
}
