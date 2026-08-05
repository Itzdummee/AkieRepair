<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'zamriyahya03@gmail.com'],
            [
                'id' => 'A001',
                'name' => 'umar',
                'phone_number' => '0187634602',
                'role' => 'admin',
                'approval_status' => 'approved',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),            ]
        );
    }
}