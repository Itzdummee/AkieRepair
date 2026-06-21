<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Repair;
use App\Models\BookingTimeline;
use App\Models\TechnicianAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'device.repairs', 'timelines'])
            ->where('technician_id', Auth::id())
            ->where('status', 'Technician Assigned')
            ->latest()
            ->get();

        $activeRepairs = Booking::with(['customer', 'device', 'timelines'])
            ->where('technician_id', Auth::id())
            ->where('status', 'Repair In Progress')
            ->latest()
            ->get();

        $totalAssigned   = $bookings->count();
        $inspectionPending = $bookings->count();
        $inProgress      = $activeRepairs->count();

        $completed = Booking::where('technician_id', Auth::id())
            ->where('status', 'Repair Completed')
            ->count();

        $unavailableDates = TechnicianAvailability::where('technician_id', Auth::id())
            ->latest()
            ->get();

        return view('technician.dashboard', compact(
            'bookings',
            'activeRepairs',
            'totalAssigned',
            'inspectionPending',
            'inProgress',
            'completed',
            'unavailableDates'
        ));
    }
    

    public function updateInspection(Request $request, Booking $booking)
{
    $request->validate([
        'repair_ids' => 'required|array',
        'repair_ids.*' => 'exists:repairs,id',
    ]);

    $repairs = Repair::whereIn('id', $request->repair_ids)->get();

    $repairNames = $repairs->pluck('repair_type')->implode(', ');

    $totalPrice = $repairs->sum('price');

    $booking->update([
        'inspection_report' => $repairNames,
        'quotation_price' => $totalPrice,
        'status' => 'Inspection Completed',
    ]);

    BookingTimeline::create([
        'booking_id' => $booking->id,
        'title' => 'Inspection Completed',
        'description' => 'Technician completed inspection and submitted detected repair problems.',
        'status' => 'Completed',
    ]);

    return redirect()
        ->route('technician.dashboard')
        ->with('success', 'Inspection report submitted successfully.');
}

    public function updateProgress(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $booking->update([
            'status' => $request->status ?? 'Repair In Progress',
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => $request->status ?? 'Repair In Progress',
            'description' => $request->note ?? 'Technician updated the repair progress.',
            'status' => 'Completed',
        ]);

        return back()->with('success', 'Repair progress updated successfully.');
    }

    public function finishRepair(Request $request, Booking $booking)
    {
        $request->validate([
            'note' => 'nullable|string',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Verify technician owns this booking
        if ($booking->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $imagePath = null;
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/proof_images', $fileName);
            $imagePath = 'storage/proof_images/' . $fileName;
        }

        $booking->update([
            'status' => 'Repair Finished',
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => 'Repair Finished',
            'description' => $request->note ?? 'Technician has completed the repair work. Awaiting customer payment.',
            'status' => 'Completed',
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Repair marked as finished. Customer will now proceed with payment.');
    }

    public function storeAvailability(Request $request)
    {
        $request->validate([
            'unavailable_date' => 'required|date|after_or_equal:today',
            'reason' => 'nullable|string|max:255',
        ]);

        TechnicianAvailability::create([
            'technician_id' => Auth::id(),
            'unavailable_date' => $request->unavailable_date,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Unavailable date added successfully.');
    }

    public function updateAvailability(Request $request, TechnicianAvailability $availability)
    {
    $request->validate([
        'unavailable_date' => 'required|date|after_or_equal:today',
        'reason' => 'nullable|string|max:255',
    ]);

    $availability->update([
        'unavailable_date' => $request->unavailable_date,
        'reason' => $request->reason,
    ]);

    return back()->with('success', 'Availability updated successfully.');
    }

    public function deleteAvailability(TechnicianAvailability $availability)
    {
        $availability->delete();

        return back()->with('delete', 'Unavailable date removed.');
    }

    public function availability()
    {
    $availabilities = \App\Models\TechnicianAvailability::where('technician_id', \Illuminate\Support\Facades\Auth::id())
        ->latest()
        ->get();

    return view('technician.availability', compact('availabilities'));
    }

    public function assignedJobs()
    {
        $jobs = \App\Models\Booking::with(['customer', 'device', 'timelines'])
            ->where('technician_id', \Illuminate\Support\Facades\Auth::id())
            ->whereIn('status', [
                'Technician Assigned',
                'Pending Inspection',
                'Pending Customer Approval',
                'Repair In Progress',
                'Repair Finished'
            ])
            ->latest()
            ->get();

        $completedCount = \App\Models\Booking::where('technician_id', \Illuminate\Support\Facades\Auth::id())
            ->where('status', 'Repair Finished')
            ->count();

        return view('technician.assigned-jobs', compact('jobs', 'completedCount'));
    }

    public function showJob(\App\Models\Booking $booking)
    {
        // Verify technician owns this booking
        if ($booking->technician_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->load(['customer', 'device.repairs', 'timelines' => function($q) {
            $q->orderBy('created_at', 'desc');
        }]);

        return view('technician.job-detail', compact('booking'));
    }
}