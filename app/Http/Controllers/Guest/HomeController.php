<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Device;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with(['repairs.device'])->get();
        $devices = Device::with(['repairs.service'])->get();

        return view('guest.home', compact('services', 'devices'));
    }
}