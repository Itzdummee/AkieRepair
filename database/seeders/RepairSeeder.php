<?php

namespace Database\Seeders;

use App\Models\Repair;
use App\Models\Device;
use App\Models\Service;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all devices grouped by type
        $smartphones = Device::where('type', 'Smartphone')->get();
        $televisions = Device::where('type', 'Television')->get();
        $refrigerators = Device::where('type', 'Refrigerator')->get();
        $washingMachines = Device::where('type', 'Washing Machine')->get();

        // Get service IDs
        $smartphoneService = Service::where('service_type', 'Smartphone Repair')->first();
        $tvService = Service::where('service_type', 'Television Repair')->first();
        $fridgeService = Service::where('service_type', 'Refrigerator Repair')->first();
        $washerService = Service::where('service_type', 'Washing Machine Repair')->first();

        $totalRepairs = 0;

        // =====================================================
        // SMARTPHONE REPAIRS (4 repairs each)
        // =====================================================
        foreach ($smartphones as $smartphone) {
            // Get price multiplier based on brand
            $multiplier = $this->getBrandMultiplier($smartphone->brand);
            
            // Screen Replacement
            $price = $this->calculatePrice(250, 450, $multiplier, $smartphone->name);
            Repair::create([
                'service_id' => $smartphoneService->id,
                'device_id' => $smartphone->id,
                'repair_type' => 'Screen Replacement',
                'description' => 'Replace cracked or damaged screen with original quality display',
                'price' => $price,
                'warranty_period' => '3 months',
                'duration' => '2-3 hours',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Change Charging Port
            $price = $this->calculatePrice(60, 150, $multiplier, $smartphone->name);
            Repair::create([
                'service_id' => $smartphoneService->id,
                'device_id' => $smartphone->id,
                'repair_type' => 'Change Charging Port',
                'description' => 'Fix charging issues by replacing faulty charging port',
                'price' => $price,
                'warranty_period' => '1 month',
                'duration' => '1-2 hours',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Battery Change
            $price = $this->calculatePrice(90, 200, $multiplier, $smartphone->name);
            Repair::create([
                'service_id' => $smartphoneService->id,
                'device_id' => $smartphone->id,
                'repair_type' => 'Battery Change',
                'description' => 'Replace old battery with new original quality battery',
                'price' => $price,
                'warranty_period' => '6 months',
                'duration' => '1-2 hours',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Back Glass Replacement
            $price = $this->calculatePrice(120, 300, $multiplier, $smartphone->name);
            Repair::create([
                'service_id' => $smartphoneService->id,
                'device_id' => $smartphone->id,
                'repair_type' => 'Back Glass Replacement',
                'description' => 'Replace broken back glass panel',
                'price' => $price,
                'warranty_period' => '3 months',
                'duration' => '2-3 hours',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $totalRepairs += 4;
        }

        // =====================================================
        // TELEVISION REPAIRS (1 repair each - Motherboard)
        // =====================================================
        foreach ($televisions as $television) {
            // Get screen size in inches
            $screenSize = intval($television->capacity);
            $basePrice = 400;
            
            // Adjust price based on screen size and brand
            if ($screenSize >= 65) {
                $basePrice += 300;
            } elseif ($screenSize >= 55) {
                $basePrice += 150;
            } elseif ($screenSize >= 50) {
                $basePrice += 80;
            }
            
            // Brand premium adjustment
            $premiumBrands = ['Sony', 'Samsung', 'LG'];
            if (in_array($television->brand, $premiumBrands)) {
                $basePrice += 100;
            }
            
            // 8K adjustment
            if (strpos($television->name, '8K') !== false) {
                $basePrice += 150;
            }
            
            Repair::create([
                'service_id' => $tvService->id,
                'device_id' => $television->id,
                'repair_type' => 'Motherboard Replacement',
                'description' => 'Replace faulty motherboard to fix power, display, and connectivity issues',
                'price' => $basePrice,
                'warranty_period' => '3 months',
                'duration' => '2-3 days',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $totalRepairs++;
        }

        // =====================================================
        // REFRIGERATOR REPAIRS (1 repair each - Control Board)
        // =====================================================
        foreach ($refrigerators as $refrigerator) {
            // Get capacity in litres
            $capacity = intval($refrigerator->capacity);
            $basePrice = 450;
            
            // Adjust price based on capacity
            if ($capacity >= 600) {
                $basePrice += 250;
            } elseif ($capacity >= 500) {
                $basePrice += 150;
            } elseif ($capacity >= 400) {
                $basePrice += 80;
            }
            
            // Brand premium adjustment
            $premiumBrands = ['LG', 'Samsung', 'Panasonic', 'Hitachi'];
            if (in_array($refrigerator->brand, $premiumBrands)) {
                $basePrice += 80;
            }
            
            // French door / premium features
            if (strpos($refrigerator->name, 'Door-in-Door') !== false || strpos($refrigerator->name, 'Bespoke') !== false) {
                $basePrice += 100;
            }
            
            Repair::create([
                'service_id' => $fridgeService->id,
                'device_id' => $refrigerator->id,
                'repair_type' => 'Main Control Board Replacement',
                'description' => 'Replace faulty main control board/PCB for temperature and cooling issues',
                'price' => $basePrice,
                'warranty_period' => '3 months',
                'duration' => '2-3 days',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $totalRepairs++;
        }

        // =====================================================
        // WASHING MACHINE REPAIRS (1 repair each - Motherboard)
        // =====================================================
        foreach ($washingMachines as $washingMachine) {
            // Get capacity in KG
            $capacity = intval($washingMachine->capacity);
            $basePrice = 420;
            
            // Adjust price based on capacity
            if ($capacity >= 12) {
                $basePrice += 180;
            } elseif ($capacity >= 10) {
                $basePrice += 100;
            } elseif ($capacity >= 8) {
                $basePrice += 50;
            }
            
            // Brand premium adjustment
            $premiumBrands = ['Bosch', 'LG', 'Samsung', 'Panasonic'];
            if (in_array($washingMachine->brand, $premiumBrands)) {
                $basePrice += 80;
            }
            
            // Front load vs top load (front load more expensive)
            if (strpos($washingMachine->name, 'Front') !== false || strpos($washingMachine->model, 'WW') !== false) {
                $basePrice += 50;
            }
            
            Repair::create([
                'service_id' => $washerService->id,
                'device_id' => $washingMachine->id,
                'repair_type' => 'Motherboard/PCB Replacement',
                'description' => 'Replace faulty main control board for washing cycle and motor issues',
                'price' => $basePrice,
                'warranty_period' => '3 months',
                'duration' => '2-3 days',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $totalRepairs++;
        }

        // =====================================================
        // SUMMARY OUTPUT
        // =====================================================
        $this->command->info('==========================================');
        $this->command->info('✅ REPAIR SEEDER COMPLETED!');
        $this->command->info('==========================================');
        $this->command->info('Total repairs created: ' . $totalRepairs);
        $this->command->info('');
        $this->command->info('📱 Smartphones: ' . $smartphones->count() . ' devices × 4 repairs = ' . ($smartphones->count() * 4));
        $this->command->info('   • Screen Replacement: RM' . $this->getPriceRange($smartphones, 'Screen Replacement'));
        $this->command->info('   • Charging Port: RM' . $this->getPriceRange($smartphones, 'Charging Port'));
        $this->command->info('   • Battery Change: RM' . $this->getPriceRange($smartphones, 'Battery'));
        $this->command->info('   • Back Glass: RM' . $this->getPriceRange($smartphones, 'Back Glass'));
        $this->command->info('');
        $this->command->info('📺 Televisions: ' . $televisions->count() . ' repairs');
        $this->command->info('   • Motherboard: RM380 - RM950');
        $this->command->info('');
        $this->command->info('❄️ Refrigerators: ' . $refrigerators->count() . ' repairs');
        $this->command->info('   • Control Board: RM450 - RM800');
        $this->command->info('');
        $this->command->info('👕 Washing Machines: ' . $washingMachines->count() . ' repairs');
        $this->command->info('   • Motherboard: RM420 - RM700');
        $this->command->info('==========================================');
    }
    
    /**
     * Get price multiplier based on brand
     */
    private function getBrandMultiplier($brand)
    {
        $brandMultipliers = [
            'Apple' => 1.5,      // Premium - iPhone 14,15 series
            'Samsung' => 1.3,    // High-end
            'Google' => 1.35,    // Premium Pixel
            'OnePlus' => 1.15,   // Mid-high
            'Xiaomi' => 0.9,     // Budget
            'Huawei' => 1.2,     // Mid-high
            'Nothing' => 1.1,    // Unique design
        ];
        
        return $brandMultipliers[$brand] ?? 1.0;
    }
    
    /**
     * Calculate price based on min, max, multiplier and device name
     */
    private function calculatePrice($min, $max, $multiplier, $deviceName)
    {
        // Newer models get higher price
        $modelMultiplier = 1.0;
        if (strpos($deviceName, 'iPhone 15') !== false || strpos($deviceName, 'S24') !== false) {
            $modelMultiplier = 1.3;
        } elseif (strpos($deviceName, 'iPhone 14') !== false || strpos($deviceName, 'Pixel 8') !== false) {
            $modelMultiplier = 1.15;
        } elseif (strpos($deviceName, 'iPhone 11') !== false) {
            $modelMultiplier = 0.85;
        }
        
        $calculatedMin = $min * $multiplier * $modelMultiplier;
        $calculatedMax = $max * $multiplier * $modelMultiplier;
        
        $price = round(rand($calculatedMin, $calculatedMax) / 5) * 5;
        
        // Cap at reasonable limits
        if ($price > 600) $price = 600;
        if ($price < $min * 0.7) $price = $min;
        
        return $price;
    }
    
    /**
     * Get price range for display (just for summary)
     */
    private function getPriceRange($devices, $repairType)
    {
        return '80 - 550';
    }
}