<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingTimeline;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function create()
    {   
        $devices = Device::where('is_active', true)->latest()->get();

        return view('customer.booking-create', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'device_id' => [
                'required',
                Rule::exists('devices', 'id')->where('is_active', true),
            ],
            'problem_description' => 'required|string',
            'visit_date' => 'required|date|after_or_equal:today',
            'alternative_visit_date' => 'nullable|date|after_or_equal:today|different:visit_date',
        ]);

        $device = Device::findOrFail($request->device_id);
        $visitDate = $request->visit_date;
        $usedAlternativeDate = false;

        if ($this->availableTechniciansCount($visitDate, $device) === 0) {
            if (! $request->filled('alternative_visit_date')) {
                return back()
                    ->withErrors([
                        'visit_date' => 'No technician is available on this date. Please add another date for your site visit.',
                    ])
                    ->withInput();
            }

            if ($this->availableTechniciansCount($request->alternative_visit_date, $device) === 0) {
                return back()
                    ->withErrors([
                        'alternative_visit_date' => 'No technician is available on the alternative date. Please choose another date.',
                    ])
                    ->withInput();
            }

            $visitDate = $request->alternative_visit_date;
            $usedAlternativeDate = true;
        }

        $booking = Booking::create([
            'customer_id' => Auth::id(),
            'device_id' => $request->device_id,
            'problem_description' => $request->problem_description,
            'visit_date' => $visitDate,
            'status' => 'Visit Requested',
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => 'Visit Requested',
            'description' => 'Your booking request has been submitted and is waiting for admin review.',
            'status' => 'Completed',
        ]);

        return redirect()
            ->route('customer.booking.status')
            ->with(
                'success',
                $usedAlternativeDate
                    ? 'Your preferred date was unavailable, so your booking was submitted with the alternative visit date.'
                    : 'Booking request submitted successfully.'
            );
    }

    private function availableTechniciansCount(string $date, Device $device): int
    {
        return User::where('role', 'technician')
            ->where('approval_status', 'approved')
            ->where('is_active', true)
            ->when($device->type, function ($query) use ($device) {
                $query->whereRaw('LOWER(specialty) LIKE ?', ['%' . strtolower($device->type) . '%']);
            })
            ->whereDoesntHave('availabilities', function ($query) use ($date) {
                $query->coveringDate($date);
            })
            ->count();
    }

    public function status()
    {
        $bookings = Booking::with(['device', 'technician', 'timelines', 'repair', 'review'])
            ->where('customer_id', Auth::id())
            ->whereNotIn('status', ['Repair Completed', 'Quotation Rejected', 'Cancelled'])
            ->latest()
            ->get();

        return view('customer.booking-status', compact('bookings'));
    }

    public function history()
    {
        $bookings = Booking::with(['device', 'technician', 'timelines', 'repair', 'review'])
            ->where('customer_id', Auth::id())
            ->whereIn('status', ['Repair Completed', 'Quotation Rejected', 'Cancelled'])
            ->latest()
            ->get();

        return view('customer.booking-history', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        // Ensure customer can only view their own booking
        if ($booking->customer_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['device', 'technician', 'timelines', 'repair', 'review']);
        $from = in_array($booking->status, ['Repair Completed', 'Quotation Rejected', 'Cancelled'])
            ? 'history'
            : 'status';

        return view('customer.booking-detail', compact('booking', 'from'));
    }

    public function acceptQuotation(Booking $booking)
    {
        $booking->update([
            'quotation_status' => 'Accepted',
            'status'           => 'Repair In Progress',
        ]);

        BookingTimeline::create([
            'booking_id'  => $booking->id,
            'title'       => 'Quotation Accepted',
            'description' => 'Customer accepted the quotation.',
            'status'      => 'Completed',
        ]);

        BookingTimeline::create([
            'booking_id'  => $booking->id,
            'title'       => 'Repair In Progress',
            'description' => 'Technician has been notified and is now working on the repair.',
            'status'      => 'Completed',
        ]);

        return back()->with('success', 'Quotation accepted! The technician is now working on your repair.');
    }

    public function rejectQuotation(Booking $booking)
    {
        $booking->update([
            'quotation_status' => 'Rejected',
            'status' => 'Quotation Rejected',
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => 'Quotation Rejected',
            'description' => 'Customer rejected the quotation.',
            'status' => 'Completed',
        ]);

        return redirect()->route('customer.booking.history')->with('delete', 'Quotation rejected.');
    }
}
