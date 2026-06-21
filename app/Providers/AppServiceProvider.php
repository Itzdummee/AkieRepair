<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {
            $pendingCustomersCount = 0;
            $pendingBookingsCount = 0;
            $pendingQuotationsCount = 0;

            try {
                if (Schema::hasTable('users')) {
                    $pendingCustomersCount = User::where('role', 'customer')
                        ->where('approval_status', 'pending')
                        ->count();
                }

                if (Schema::hasTable('bookings')) {
                    $pendingBookingsCount = Booking::where('status', 'Visit Requested')
                        ->count();

                    $pendingQuotationsCount = Booking::where('status', 'Inspection Completed')
                        ->count();
                }
            } catch (\Exception $e) {
                // Fail-safe during migrations, console runs, or database setup
            }

            $view->with(compact('pendingCustomersCount', 'pendingBookingsCount', 'pendingQuotationsCount'));
        });

        View::composer('layouts.technician', function ($view) {
            $pendingInspectionsCount = 0;
            $activeRepairsCount = 0;

            try {
                if (\Illuminate\Support\Facades\Auth::check()) {
                    $techId = \Illuminate\Support\Facades\Auth::id();

                    if (Schema::hasTable('bookings')) {
                        $pendingInspectionsCount = Booking::where('technician_id', $techId)
                            ->where('status', 'Technician Assigned')
                            ->count();

                        $activeRepairsCount = Booking::where('technician_id', $techId)
                            ->where('status', 'Repair In Progress')
                            ->count();
                    }
                }
            } catch (\Exception $e) {
                // Fail-safe
            }

            $view->with(compact('pendingInspectionsCount', 'activeRepairsCount'));
        });
    }
}
