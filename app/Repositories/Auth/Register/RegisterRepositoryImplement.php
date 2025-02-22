<?php
namespace App\Repositories\Auth\Register;

use App\Repositories\Auth\Register\RegisterRepository;
use App\Models\User;

class RegisterRepositoryImplement implements RegisterRepository
{
    /**
     * Menyimpan data pengguna baru.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Mencari pengguna berdasarkan email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
