<?php

namespace App\Repositories\Auth\Register;

use App\Models\User;

interface RegisterRepository
{
    public function create(array $data): User;
    public function findByEmail(string $email): ?User;
}
