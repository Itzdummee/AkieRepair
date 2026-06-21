<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Smartphone Repair',
            'Refrigerator Repair',
            'Television Repair',
            'Washing Machine Repair',
        ];

        foreach ($services as $serviceType) {
            Service::updateOrCreate(
                ['service_type' => $serviceType],
                ['admin_id' => null]
            );
        }
    }
}
