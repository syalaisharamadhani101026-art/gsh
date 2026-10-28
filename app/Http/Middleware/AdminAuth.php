<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     * Ensure only authenticated admin staff can access admin routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Sesi login admin dibutuhkan.',
                ], 401);
            }

            return redirect()->route('admin.login')
                ->with('error', 'Akses khusus staf administrator & front desk. Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
