<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingTimeline;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {   
        $devices = Device::latest()->get();

        return view('customer.booking-create', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'problem_description' => 'required|string',
            'visit_date' => 'nullable|date',
        ]);

        $booking = Booking::create([
            'customer_id' => Auth::id(),
            'device_id' => $request->device_id,
            'problem_description' => $request->problem_description,
            'visit_date' => $request->visit_date,
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
            ->with('success', 'Booking request submitted successfully.');
    }

    public function status()
    {
        $bookings = Booking::with(['device', 'technician', 'timelines', 'repair'])
            ->where('customer_id', Auth::id())
            ->whereNotIn('status', ['Repair Completed', 'Quotation Rejected', 'Cancelled'])
            ->latest()
            ->get();

        return view('customer.booking-status', compact('bookings'));
    }

    public function history()
    {
        $bookings = Booking::with(['device', 'technician', 'timelines', 'repair'])
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

        $booking->load(['device', 'technician', 'timelines', 'repair']);
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