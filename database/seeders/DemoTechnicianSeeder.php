<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoTechnicianSeeder extends Seeder
{
    public function run(): void
    {
        $technicians = [
            [
                'id' => 'T001',
                'name' => 'Aiman',
                'email' => 'technician01@gmail.com',
                'phone_number' => '0121000001',
                'specialty' => 'Smartphone',
            ],
            [
                'id' => 'T002',
                'name' => 'Balqis',
                'email' => 'technician02@gmail.com',
                'phone_number' => '0121000002',
                'specialty' => 'Television',
            ],
            [
                'id' => 'T003',
                'name' => 'Chen',
                'email' => 'technician03@gmail.com',
                'phone_number' => '0121000003',
                'specialty' => 'Refrigerator',
            ],
            [
                'id' => 'T004',
                'name' => 'Danish',
                'email' => 'technician04@gmail.com',
                'phone_number' => '0121000004',
                'specialty' => 'Washing Machine',
            ],
        ];

        foreach ($technicians as $technician) {
            User::updateOrCreate(
                ['id' => $technician['id']],
                [
                    'name' => $technician['name'],
                    'email' => $technician['email'],
                    'phone_number' => $technician['phone_number'],
                    'role' => 'technician',
                    'approval_status' => 'approved',
                    'email_verified_at' => now(),
                    'specialty' => $technician['specialty'],
                    'password' => Hash::make('Paswod'),
                ]
            );
        }

        $this->command?->info('4 demo technicians seeded by device specialty. Password: Paswod');
    }
}
