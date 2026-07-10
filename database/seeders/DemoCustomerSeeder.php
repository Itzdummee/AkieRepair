<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoCustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ms_MY');
        $faker->seed(150);

        for ($i = 1; $i <= 150; $i++) {
            User::updateOrCreate(
                ['id' => 'C' . str_pad($i, 3, '0', STR_PAD_LEFT)],
                [
                    'name' => str($faker->firstName())->before(' ')->toString(),
                    'email' => "customer0{$i}@gmail.com",
                    'phone_number' => '011' . str_pad((string) $i, 8, '0', STR_PAD_LEFT),
                    'role' => 'customer',
                    'approval_status' => 'approved',
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]
            );
        }

        $this->command?->info('150 demo customers seeded. Email starts at customer1@gmail.com, password: password');
    }
}
