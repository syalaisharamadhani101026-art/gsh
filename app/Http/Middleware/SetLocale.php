<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Prioritize direct URL query ?lang=id or ?lang=en
        if ($request->has('lang') && in_array($request->query('lang'), ['en', 'id'])) {
            $locale = $request->query('lang');
            session(['locale' => $locale]);
            cookie()->queue(cookie('locale', $locale, 60 * 24 * 365, '/'));
        } else {
            // 2. Read from session, or persistent cookie, or fallback to 'id'
            $locale = session('locale', $request->cookie('locale', config('app.locale', 'id')));
        }

        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'id';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
