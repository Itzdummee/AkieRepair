<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\Device;
use App\Models\Service;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::with(['service', 'device'])
            ->latest()
            ->get();

        $services = Service::with('repairs')
            ->latest()
            ->get();

        $devices = Device::latest()->get();

        // Calculate overview stats for the unified dashboard
        $totalServices = $services->count();
        $totalRepairs = $repairs->count();
        $avgRepairPrice = $repairs->avg('price') ?? 0;
        
        // Find popular service (most repair types registered)
        $popularService = $services->sortByDesc(function ($service) {
            return $service->repairs->count();
        })->first();
        
        $popularServiceName = $popularService ? $popularService->service_type : 'N/A';

        return view('admin.repairs', compact(
            'repairs',
            'services',
            'devices',
            'totalServices',
            'totalRepairs',
            'avgRepairPrice',
            'popularServiceName'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'device_id' => 'required|exists:devices,id',
            'repair_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'warranty_period' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        Repair::create([
            'service_id' => $request->service_id,
            'device_id' => $request->device_id,
            'repair_type' => $request->repair_type,
            'description' => $request->description,
            'price' => $request->price,
            'warranty_period' => $request->warranty_period,
            'duration' => $request->duration,
            'image' => $request->image,
        ]);

        return redirect()
            ->to(route('admin.repairs') . '#repair')
            ->with('success', 'Repair added successfully.');
    }

    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'device_id' => 'required|exists:devices,id',
            'repair_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'warranty_period' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $repair->update([
            'service_id' => $request->service_id,
            'device_id' => $request->device_id,
            'repair_type' => $request->repair_type,
            'description' => $request->description,
            'price' => $request->price,
            'warranty_period' => $request->warranty_period,
            'duration' => $request->duration,
            'image' => $request->image,
        ]);

        return redirect()
            ->to(route('admin.repairs') . '#repair')
            ->with('success', 'Repair updated successfully.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();

        return redirect()
            ->to(route('admin.repairs') . '#repair')
            ->with('delete', 'Repair deleted successfully.');
    }
}