<?php
namespace App\Repositories\Auth\Login;
use App\Repositories\Auth\Login\LoginRepository;
use App\Models\User;
class LoginRepositoryImplement implements LoginRepository
{
    protected $LoginRepository;

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}


?>