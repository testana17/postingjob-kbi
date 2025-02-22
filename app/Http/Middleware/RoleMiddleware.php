<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        // Jika role tidak sesuai, arahkan ke halaman lain (tanpa memicu loop redirect)
        if (!in_array($user->role, $roles)) {
            if ($request->route()->getName() === 'company.dashboard' && $user->role !== 'company') {
                return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            if ($request->route()->getName() === 'user.dashboard' && $user->role !== 'user') {
                return redirect()->route('company.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            return redirect()->route('login')->with('error', 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
