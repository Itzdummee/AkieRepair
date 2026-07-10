<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index()
{
    $services = Service::with(['repairs' => fn ($query) => $query->where('is_active', true), 'repairs.device'])
        ->where('is_active', true)
        ->get();
    $devices = Device::with(['repairs' => fn ($query) => $query->where('is_active', true), 'repairs.service'])
        ->where('is_active', true)
        ->get();

    return view('guest.home', compact('services', 'devices'));
}
}
