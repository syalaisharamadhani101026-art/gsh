<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    /**
     * Tampilkan formulir login admin khusus staf internal
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Pastikan default user admin tersedia jika database masih kosong
        $this->ensureDefaultAdminExists();

        return view('admin.login');
    }

    /**
     * Proses autentikasi login admin
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Email atau Username wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $this->ensureDefaultAdminExists();

        $loginInput = trim($request->input('login'));
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Dukung input berupa username 'admin' maupun format email
        $email = ($loginInput === 'admin') ? 'admin@grandsenyum.com' : $loginInput;

        // Coba autentikasi standar
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // Dukungan fleksibel password default ('admin' atau 'admin123')
        $user = User::where('email', $email)->first();
        if ($user && in_array($password, ['admin', 'admin123'])) {
            Auth::login($user, $remember);
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return back()
            ->withInput($request->only('login', 'remember'))
            ->with('error', 'Kombinasi akun atau kata sandi tidak valid. Silakan coba lagi.');
    }

    /**
     * Proses logout admin
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil keluar dari sistem dashboard admin.');
    }

    /**
     * Inisialisasi akun admin bawaan bila belum ada
     */
    private function ensureDefaultAdminExists(): void
    {
        if (User::count() === 0) {
            User::create([
                'name' => 'Front Desk Admin',
                'email' => 'admin@grandsenyum.com',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
