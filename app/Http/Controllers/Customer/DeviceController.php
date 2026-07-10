<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with(['smartphone', 'homeAppliance'])
            ->where('is_active', true)
            ->latest()
            ->get();

        $smartphones = $devices->filter(fn($device) => $device->smartphone);

        $televisions = $devices->filter(fn($device) =>
            optional($device->homeAppliance)->appliance_type === 'Television'
        );

        $washingMachines = $devices->filter(fn($device) =>
            optional($device->homeAppliance)->appliance_type === 'Washing Machine'
        );

        $refrigerators = $devices->filter(fn($device) =>
            optional($device->homeAppliance)->appliance_type === 'Refrigerator'
        );

        return view('customer.devices', compact(
            'smartphones',
            'televisions',
            'washingMachines',
            'refrigerators'
        ));
    }
}
