<?php
namespace App\Services\Auth\Login;

use App\Repositories\Auth\Login\LoginRepository;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginServiceImplement implements LoginService
{
    protected $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();

            // Ambil user dari repository
            $user = $this->loginRepository->findByEmail($data['email']);

            // Cek peran pengguna
            if ($user->role === 'company') {
                return redirect()->route('jobs-company.index');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->with('error', 'Email atau Kata Sandi salah!');
    }
}
