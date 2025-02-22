<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */


     public function handle(Request $request, Closure $next)
{
    // Session::start();

    if ($request->is('login') || $request->is('register')) {
        return $next($request);
    }

    // Log session data
    // Log::info('Session JWT Token:', ['token' => Session::get('jwt_token')]);

    // Ambil token dari Authorization header atau session
    $token = $request->bearerToken() ?? Session::get('jwt_token');
    // Log::info('Token dari request atau session:', ['token' => $token]);

    if (!$token) {
        return redirect()->route('login')->withErrors(['error' => 'Token tidak ditemukan.']);
    }

    try {
        $user = JWTAuth::setToken($token)->authenticate();
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'User tidak ditemukan.']);
        }

        auth()->setUser($user);
    } catch (JWTException $e) {
        return redirect()->route('login')->withErrors(['error' => 'Terjadi kesalahan saat memproses token.']);
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return redirect()->route('login')->withErrors(['error' => 'Token tidak valid.']);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return redirect()->route('login')->withErrors(['error' => 'Token kadaluarsa.']);
    }

    return $next($request);
}



    private function unauthorizedResponse($message)
{
    if (request()->expectsJson()) {
        return response()->json(['error' => $message], Response::HTTP_UNAUTHORIZED);
    }

    return redirect()->route('login')->withErrors(['error' => $message]);
}
}
