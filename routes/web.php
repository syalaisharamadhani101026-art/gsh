<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestPortalController;
use Illuminate\Support\Facades\Route;

// Language Switcher (EN / ID)
Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'id'])) {
        $locale = 'id';
    }
    session(['locale' => $locale]);
    cookie()->queue(cookie('locale', $locale, 60 * 24 * 365, '/'));

    $referer = request()->headers->get('referer');
    if ($referer) {
        $cleanReferer = preg_replace('/([?&])lang=[^&]*(&|$)/', '$1', $referer);
        $cleanReferer = rtrim($cleanReferer, '?&');
        $sep = str_contains($cleanReferer, '?') ? '&' : '?';
        return redirect($cleanReferer . $sep . 'lang=' . $locale)->withCookie(cookie('locale', $locale, 60 * 24 * 365, '/'));
    }

    return redirect()->route('guest.points', ['lang' => $locale])->withCookie(cookie('locale', $locale, 60 * 24 * 365, '/'));
})->name('lang.switch');

// Redirect root ke portal cek poin tamu
Route::get('/', function () {
    return redirect()->route('guest.points');
});

// Portal Tamu / Cek Poin (tanpa login - khusus pelanggan)
Route::get('/cek-poin', [GuestPortalController::class, 'index'])->name('guest.points');

// Halaman Khusus Per Menu (Multi-page)
Route::get('/about', [GuestPortalController::class, 'about'])->name('guest.about');
Route::get('/tentang', fn() => redirect()->route('guest.about'));

Route::get('/membership-tiers', [GuestPortalController::class, 'tiers'])->name('guest.tiers');
Route::get('/tier', fn() => redirect()->route('guest.tiers'));
Route::get('/tiers', fn() => redirect()->route('guest.tiers'));

Route::get('/earn-points', [GuestPortalController::class, 'earn'])->name('guest.earn');
Route::get('/perolehan', fn() => redirect()->route('guest.earn'));

Route::get('/rewards-catalog', [GuestPortalController::class, 'catalog'])->name('guest.catalog');
Route::get('/katalog', fn() => redirect()->route('guest.catalog'));

Route::get('/faq', [GuestPortalController::class, 'faq'])->name('guest.faq');

// Redirect legacy mobile URLs ke portal cek poin
Route::get('/mobile', fn() => redirect()->route('guest.points'));
Route::get('/m', fn() => redirect()->route('guest.points'));
Route::get('/rekaman-layar', fn() => redirect()->route('guest.points'));

// Penukaran Hadiah / Redeem Point oleh Tamu
Route::post('/redeem', [GuestPortalController::class, 'redeem'])->name('guest.redeem');

// Autentikasi Khusus Admin (Login & Logout)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Area Manajemen Internal Admin (Terproteksi Middleware admin.auth)
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/stay', [AdminController::class, 'storeStay'])->name('stay.store');
        Route::match(['post', 'patch'], '/guest/{guest}/tier', [AdminController::class, 'upgradeTier'])->name('guest.tier');
        Route::post('/redemption', [AdminController::class, 'storeRedemption'])->name('redemption.store');
        Route::post('/redemption/{redemption}/status', [AdminController::class, 'updateRedemptionStatus'])->name('redemption.status');
    });
});

// API lookup untuk live search di form input admin (Hanya untuk Admin)
Route::get('/api/guest-lookup', [AdminController::class, 'lookup'])
    ->middleware('admin.auth')
    ->name('api.guest.lookup');
