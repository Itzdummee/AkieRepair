<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(RepairSeeder::class);
        $this->call(DemoTechnicianSeeder::class);
        $this->call(DemoCustomerSeeder::class);
        $this->call(DemoBusinessBookingSeeder::class);
    }
}
