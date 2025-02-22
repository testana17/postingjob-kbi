<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CompanyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
         
            'name' => 'Company Admin',
            'email' => 'company@example.com',
            'password' => bcrypt('password123'), // Gunakan bcrypt untuk hashing password
            'role' => 'company',
        ]);

        User::create([
         
            'name' => 'Wulan',
            'email' => 'wulan@gmail.com',
            'password' => bcrypt('wulan123'), // Gunakan bcrypt untuk hashing password
            'role' => 'user',
        ]);
    }
}
