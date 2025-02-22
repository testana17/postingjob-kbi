<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna sudah diautentikasi
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        // Periksa apakah peran pengguna adalah 'company'
        if (Auth::user()->role !== 'company') {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        return $next($request);
    }
}
