<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;

class RepairController extends Controller
{
    public function index(Service $service)
    {
        $repairs = $service->repairs()
            ->with('device')
            ->latest()
            ->get();

        return view('customer.repairs', compact('service', 'repairs'));
    }
        
    public function all()
    {
    $repairs = \App\Models\Repair::with(['device', 'service'])
        ->latest()
        ->get()
        ->groupBy('device_id');

    return view('customer.repairs-all', compact('repairs'));
    }
}