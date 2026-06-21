<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Device;
use App\Models\TechnicianAvailability;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TechnicianDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_technician_cannot_be_deleted_when_assigned_to_booking(): void
    {
        $technician = User::factory()->create([
            'id' => 'T001',
            'role' => 'technician',
        ]);

        $customer = User::factory()->create([
            'id' => 'C001',
            'role' => 'customer',
        ]);

        $device = Device::create([
            'name' => 'Phone',
            'brand' => 'BrandX',
            'type' => 'Smartphone',
            'model' => 'ModelX',
            'capacity' => 64,
            'capacity_unit' => 'GB',
        ]);

        Booking::create([
            'customer_id' => $customer->id,
            'device_id' => $device->id,
            'technician_id' => $technician->id,
            'problem_description' => 'Test issue',
            'status' => 'Visit Requested',
        ]);

        $response = $this->delete(route('admin.technicians.destroy', $technician));

        $response->assertSessionHasErrors('delete');
        $this->assertDatabaseHas('users', ['id' => $technician->id]);
    }

    public function test_technician_cannot_be_deleted_when_has_availability_records(): void
    {
        $technician = User::factory()->create([
            'id' => 'T002',
            'role' => 'technician',
        ]);

        TechnicianAvailability::create([
            'technician_id' => $technician->id,
            'unavailable_date' => now()->addDay()->toDateString(),
            'reason' => 'Holiday',
        ]);

        $response = $this->delete(route('admin.technicians.destroy', $technician));

        $response->assertSessionHasErrors('delete');
        $this->assertDatabaseHas('users', ['id' => $technician->id]);
    }
}
