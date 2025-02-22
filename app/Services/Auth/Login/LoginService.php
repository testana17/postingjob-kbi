<?php 
namespace App\Services\Auth\Login;
use App\Http\Requests\LoginRequest;

interface LoginService
{
    public function login(LoginRequest $request);
}

?>