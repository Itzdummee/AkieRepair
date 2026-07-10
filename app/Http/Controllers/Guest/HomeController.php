<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\BookingReview;
use App\Models\Service;
use App\Models\Device;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with(['repairs' => fn ($query) => $query->where('is_active', true), 'repairs.device'])
            ->where('is_active', true)
            ->get();
        $devices = Device::with(['repairs' => fn ($query) => $query->where('is_active', true), 'repairs.service'])
            ->where('is_active', true)
            ->get();
        $reviews = collect();

        if (Schema::hasTable('booking_reviews')) {
            $reviews = BookingReview::with([
                'customer',
                'booking.device',
                'booking.technician',
                'booking.timelines' => fn ($query) => $query
                    ->where('title', 'Repair Finished')
                    ->whereNotNull('image')
                    ->latest(),
            ])
                ->whereHas('booking', fn ($query) => $query
                    ->where('status', 'Repair Completed')
                    ->where('payment_status', 'Paid'))
                ->latest()
                ->get();
        }

        return view('guest.home', compact('services', 'devices', 'reviews'));
    }
}
