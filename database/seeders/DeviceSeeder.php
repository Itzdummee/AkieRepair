<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Smartphones (10 items) - Capacity in GB
        $smartphones = [
            ['name' => 'iPhone 14 Pro', 'brand' => 'Apple', 'model' => 'A2892', 'capacity' => '128', 'capacity_unit' => 'GB'],
            ['name' => 'iPhone 14 Pro Max', 'brand' => 'Apple', 'model' => 'A2894', 'capacity' => '256', 'capacity_unit' => 'GB'],
            ['name' => 'iPhone 15', 'brand' => 'Apple', 'model' => 'A2846', 'capacity' => '128', 'capacity_unit' => 'GB'],
            ['name' => 'Samsung Galaxy S24 Ultra', 'brand' => 'Samsung', 'model' => 'SM-S928B', 'capacity' => '256', 'capacity_unit' => 'GB'],
            ['name' => 'Samsung Galaxy S24+', 'brand' => 'Samsung', 'model' => 'SM-S926B', 'capacity' => '512', 'capacity_unit' => 'GB'],
            ['name' => 'Google Pixel 8 Pro', 'brand' => 'Google', 'model' => 'GC3VE', 'capacity' => '128', 'capacity_unit' => 'GB'],
            ['name' => 'OnePlus 12', 'brand' => 'OnePlus', 'model' => 'CPH2581', 'capacity' => '256', 'capacity_unit' => 'GB'],
            ['name' => 'Xiaomi 14 Ultra', 'brand' => 'Xiaomi', 'model' => '24031PN0DC', 'capacity' => '512', 'capacity_unit' => 'GB'],
            ['name' => 'Huawei P60 Pro', 'brand' => 'Huawei', 'model' => 'MNA-AL00', 'capacity' => '256', 'capacity_unit' => 'GB'],
            ['name' => 'Nothing Phone 2', 'brand' => 'Nothing', 'model' => 'A065', 'capacity' => '256', 'capacity_unit' => 'GB'],
        ];

        // Televisions (10 items) - Capacity in Inch (screen size)
        $televisions = [
            ['name' => 'Samsung Neo QLED 4K', 'brand' => 'Samsung', 'model' => 'QN85C', 'capacity' => '55', 'capacity_unit' => 'Inch'],
            ['name' => 'Samsung Neo QLED 8K', 'brand' => 'Samsung', 'model' => 'QN900C', 'capacity' => '65', 'capacity_unit' => 'Inch'],
            ['name' => 'LG OLED evo C3', 'brand' => 'LG', 'model' => 'OLED55C3', 'capacity' => '55', 'capacity_unit' => 'Inch'],
            ['name' => 'LG OLED evo G3', 'brand' => 'LG', 'model' => 'OLED65G3', 'capacity' => '65', 'capacity_unit' => 'Inch'],
            ['name' => 'Sony Bravia XR A80L', 'brand' => 'Sony', 'model' => 'XR-55A80L', 'capacity' => '55', 'capacity_unit' => 'Inch'],
            ['name' => 'Sony Bravia XR X90L', 'brand' => 'Sony', 'model' => 'XR-65X90L', 'capacity' => '65', 'capacity_unit' => 'Inch'],
            ['name' => 'TCL QLED 4K', 'brand' => 'TCL', 'model' => '55C745', 'capacity' => '55', 'capacity_unit' => 'Inch'],
            ['name' => 'Hisense ULED U8K', 'brand' => 'Hisense', 'model' => '55U8K', 'capacity' => '55', 'capacity_unit' => 'Inch'],
            ['name' => 'Panasonic MX800', 'brand' => 'Panasonic', 'model' => 'TX-55MX800', 'capacity' => '50', 'capacity_unit' => 'Inch'],
            ['name' => 'Philips Ambilight', 'brand' => 'Philips', 'model' => '55PUS8808', 'capacity' => '55', 'capacity_unit' => 'Inch'],
        ];

        // Refrigerators (10 items) - Capacity in Litre
        $refrigerators = [
            ['name' => 'LG InstaView Door-in-Door', 'brand' => 'LG', 'model' => 'GSXV90MCAE', 'capacity' => '635', 'capacity_unit' => 'Litre'],
            ['name' => 'Samsung Bespoke 4-Door', 'brand' => 'Samsung', 'model' => 'RF29BB8600', 'capacity' => '600', 'capacity_unit' => 'Litre'],
            ['name' => 'Panasonic NR-BW Series', 'brand' => 'Panasonic', 'model' => 'NR-BW530XM', 'capacity' => '530', 'capacity_unit' => 'Litre'],
            ['name' => 'Sharp Inverter Refrigerator', 'brand' => 'Sharp', 'model' => 'SJ-XP650MG', 'capacity' => '500', 'capacity_unit' => 'Litre'],
            ['name' => 'Toshiba GR Series', 'brand' => 'Toshiba', 'model' => 'GR-RT699WE', 'capacity' => '600', 'capacity_unit' => 'Litre'],
            ['name' => 'Hitachi R-Z Series', 'brand' => 'Hitachi', 'model' => 'R-Z710E9M', 'capacity' => '580', 'capacity_unit' => 'Litre'],
            ['name' => 'Mitsubishi MR-CX Series', 'brand' => 'Mitsubishi', 'model' => 'MR-CX450EJ', 'capacity' => '450', 'capacity_unit' => 'Litre'],
            ['name' => 'Electrolux French Door', 'brand' => 'Electrolux', 'model' => 'ENV9', 'capacity' => '620', 'capacity_unit' => 'Litre'],
            ['name' => 'Haier HRF Series', 'brand' => 'Haier', 'model' => 'HRF-628IS4', 'capacity' => '600', 'capacity_unit' => 'Litre'],
            ['name' => 'Midea Double Door', 'brand' => 'Midea', 'model' => 'MRF-550F', 'capacity' => '550', 'capacity_unit' => 'Litre'],
        ];

        // Washing Machines (10 items) - Capacity in KG
        $washingMachines = [
            ['name' => 'Samsung WW8000T', 'brand' => 'Samsung', 'model' => 'WW90T986DSH', 'capacity' => '9', 'capacity_unit' => 'KG'],
            ['name' => 'LG AI Direct Drive', 'brand' => 'LG', 'model' => 'F4V9WYP2W', 'capacity' => '9', 'capacity_unit' => 'KG'],
            ['name' => 'Panasonic NA-VX Series', 'brand' => 'Panasonic', 'model' => 'NA-VX9800L', 'capacity' => '10', 'capacity_unit' => 'KG'],
            ['name' => 'Bosch Serie 8', 'brand' => 'Bosch', 'model' => 'WAW28790AU', 'capacity' => '9', 'capacity_unit' => 'KG'],
            ['name' => 'Electrolux Ultimate Care', 'brand' => 'Electrolux', 'model' => 'EWF91483WR', 'capacity' => '9', 'capacity_unit' => 'KG'],
            ['name' => 'Toshiba AW Series', 'brand' => 'Toshiba', 'model' => 'AW-DUK1300WM', 'capacity' => '13', 'capacity_unit' => 'KG'],
            ['name' => 'Sharp ES Series', 'brand' => 'Sharp', 'model' => 'ES-FE814B', 'capacity' => '8', 'capacity_unit' => 'KG'],
            ['name' => 'Hitachi SF-P Series', 'brand' => 'Hitachi', 'model' => 'SF-P120XVS', 'capacity' => '12', 'capacity_unit' => 'KG'],
            ['name' => 'Midea Top Load', 'brand' => 'Midea', 'model' => 'MFW-1205G', 'capacity' => '12', 'capacity_unit' => 'KG'],
            ['name' => 'Haier HW Series', 'brand' => 'Haier', 'model' => 'HW90-B14959', 'capacity' => '9', 'capacity_unit' => 'KG'],
        ];

        // Insert all devices with their respective types
        foreach ($smartphones as $device) {
            Device::create([
                'name' => $device['name'],
                'brand' => $device['brand'],
                'type' => 'Smartphone',
                'model' => $device['model'],
                'capacity' => $device['capacity'],
                'capacity_unit' => $device['capacity_unit'],
                'image' => null,
            ]);
        }

        foreach ($televisions as $device) {
            Device::create([
                'name' => $device['name'],
                'brand' => $device['brand'],
                'type' => 'Television',
                'model' => $device['model'],
                'capacity' => $device['capacity'],
                'capacity_unit' => $device['capacity_unit'],
                'image' => null,
            ]);
        }

        foreach ($refrigerators as $device) {
            Device::create([
                'name' => $device['name'],
                'brand' => $device['brand'],
                'type' => 'Refrigerator',
                'model' => $device['model'],
                'capacity' => $device['capacity'],
                'capacity_unit' => $device['capacity_unit'],
                'image' => null,
            ]);
        }

        foreach ($washingMachines as $device) {
            Device::create([
                'name' => $device['name'],
                'brand' => $device['brand'],
                'type' => 'Washing Machine',
                'model' => $device['model'],
                'capacity' => $device['capacity'],
                'capacity_unit' => $device['capacity_unit'],
                'image' => null,
            ]);
        }

        $this->command->info('40 devices seeded successfully (10 per type)');
    }
}