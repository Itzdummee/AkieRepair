<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::latest()->get();

        return view('admin.devices', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'capacity_unit' => 'required|string|max:50',
            'image' => 'nullable|string|max:255',
        ]);

        Device::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'model' => $request->model,
            'capacity' => $request->capacity,
            'capacity_unit' => $request->capacity_unit,
            'image' => $request->image,
        ]);

        return redirect()
            ->route('admin.devices')
            ->with('success', 'Device added successfully.');
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'capacity_unit' => 'required|string|max:50',
            'image' => 'nullable|string|max:255',
        ]);

        $device->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'model' => $request->model,
            'capacity' => $request->capacity,
            'capacity_unit' => $request->capacity_unit,
            'image' => $request->image,
        ]);

        return redirect()
            ->route('admin.devices')
            ->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->update([
            'is_active' => ! $device->is_active,
        ]);

        $message = $device->is_active
            ? 'Device activated successfully.'
            : 'Device deactivated successfully.';

        return redirect()
            ->route('admin.devices')
            ->with('delete', $message);
    }
}
