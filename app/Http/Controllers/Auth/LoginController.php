<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\Login\LoginService;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
// use App\Repositories\Auth\Login\LoginRepository;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login menggunakan JWT.
     */
    public function login(LoginRequest $request)
    {
        return $this->loginService->login($request);
    }

    /**
     * Proses logout.
     */
    public function logout()
{
    Auth::logout(); // Logout user dari sesi saat ini

    request()->session()->invalidate(); // Hapus sesi
    request()->session()->regenerateToken(); // Regenerasi CSRF token

    return redirect()->route('login')->with('success', 'Anda berhasil logout.');
}
}
