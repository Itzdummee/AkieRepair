<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Device;
use App\Models\Service;
use App\Models\Repair;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Core account and database records count
        $totalCustomers = User::where('role', 'customer')->count();
        $pendingCustomers = User::where('role', 'customer')
            ->where('approval_status', 'pending')
            ->count();
        $totalTechnicians = User::where('role', 'technician')->count();
        $totalDevices = Device::count();
        $totalServices = Service::count();
        $totalRepairs = Repair::count();

        // Advanced financial & operational metrics
        // Calculated only from completed bookings as requested
        $totalSales = Booking::where('status', 'Repair Completed')
            ->sum('quotation_price');

        $averageTicketValue = Booking::where('status', 'Repair Completed')
            ->avg('quotation_price') ?? 0;

        $activeRepairs = Booking::whereIn('status', [
            'Technician Assigned',
            'Inspection Completed',
            'Quotation Sent',
            'Quotation Accepted',
            'Repair In Progress',
            'Pickup Scheduled'
        ])->count();

        $completedRepairsCount = Booking::where('status', 'Repair Completed')->count();

        // Fetch recent booking activities (latest 5)
        $recentBookings = Booking::with(['customer', 'device'])
            ->latest()
            ->limit(5)
            ->get();

        // Generate past 6 months data for monthly trends
        $months = collect();
        $bookingCounts = collect();
        $salesRevenue = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push($date->format('M Y'));

            $count = Booking::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $bookingCounts->push($count);

            $revenue = Booking::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'Repair Completed')
                ->sum('quotation_price');
            $salesRevenue->push($revenue);
        }

        // Fetch device distributions
        $deviceDistribution = Device::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'pendingCustomers',
            'totalTechnicians',
            'totalDevices',
            'totalServices',
            'totalRepairs',
            'totalSales',
            'averageTicketValue',
            'activeRepairs',
            'completedRepairsCount',
            'recentBookings',
            'months',
            'bookingCounts',
            'salesRevenue',
            'deviceDistribution'
        ));
    }
}