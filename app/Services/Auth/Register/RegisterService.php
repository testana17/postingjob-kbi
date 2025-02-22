<?php

namespace App\Services\Auth\Register;
use App\Http\Requests\RegisterRequest;

interface RegisterService
{
    public function register(RegisterRequest $request);
}
