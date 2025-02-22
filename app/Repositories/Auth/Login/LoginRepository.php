<?php
namespace App\Repositories\Auth\Login;
use App\Models\User;

interface LoginRepository
{
    public function findByEmail(string $email): ?User;
}
