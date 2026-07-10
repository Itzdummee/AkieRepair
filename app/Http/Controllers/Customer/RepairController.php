<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;

class RepairController extends Controller
{
    public function index(Service $service)
    {
        abort_unless($service->is_active, 404);

        $repairs = $service->repairs()
            ->with('device')
            ->where('is_active', true)
            ->whereHas('device', fn ($query) => $query->where('is_active', true))
            ->latest()
            ->get();

        return view('customer.repairs', compact('service', 'repairs'));
    }
        
    public function all()
    {
    $repairs = \App\Models\Repair::with(['device', 'service'])
        ->where('is_active', true)
        ->whereHas('device', fn ($query) => $query->where('is_active', true))
        ->whereHas('service', fn ($query) => $query->where('is_active', true))
        ->latest()
        ->get()
        ->groupBy('device_id');

    return view('customer.repairs-all', compact('repairs'));
    }
}
