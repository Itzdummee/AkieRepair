<?php

namespace App\Http\Controllers\Technician;

use App\Services\CloudinaryService;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Repair;
use App\Models\BookingTimeline;
use App\Models\TechnicianAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
            'customer',
            'device.repairs' => fn ($query) => $query->where('is_active', true),
            'timelines',
        ])
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
    

    public function showInspection(Booking $booking)
    {
        if ($booking->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($booking->status !== 'Technician Assigned') {
            return redirect()
                ->route('technician.dashboard')
                ->with('error', 'This booking is no longer awaiting inspection.');
        }

        $booking->load([
            'customer',
            'device.repairs' => fn ($query) => $query->where('is_active', true),
            'timelines' => function ($q) {
                $q->latest();
            },
        ]);

        return view('technician.inspection-detail', compact('booking'));
    }

    public function updateInspection(Request $request, Booking $booking)
    {
        if ($booking->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'repair_ids' => 'nullable|array',
            'repair_ids.*' => [
                Rule::exists('repairs', 'id')
                    ->where('device_id', $booking->device_id)
                    ->where('is_active', true),
            ],
            'uncovered_problem_remark' => 'nullable|string|max:1000',
        ]);

        $repairIds = $request->input('repair_ids', []);
        $remark = trim((string) $request->input('uncovered_problem_remark'));

        if (empty($repairIds) && $remark === '') {
            return back()
                ->withErrors(['repair_ids' => 'Select at least one priced repair or add a remark for an uncovered problem.'])
                ->withInput();
        }

        $repairs = Repair::whereIn('id', $repairIds)
            ->where('device_id', $booking->device_id)
            ->where('is_active', true)
            ->get();
        $repairNames = $repairs->pluck('repair_type')->implode(', ');
        $totalPrice = $repairs->sum('price');

        $reportParts = [];
        if ($repairNames !== '') {
            $reportParts[] = 'Covered repair(s): ' . $repairNames;
        }
        if ($remark !== '') {
            $reportParts[] = 'Uncovered problem remark: ' . $remark;
        }

        $booking->update([
            'inspection_report' => implode("\n", $reportParts),
            'quotation_price' => $totalPrice,
            'status' => 'Inspection Completed',
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => 'Inspection Completed',
            'description' => $remark !== ''
                ? 'Technician completed inspection and added a remark for an uncovered problem.'
                : 'Technician completed inspection and submitted detected repair problems.',
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

    public function finishRepair(Request $request, Booking $booking, CloudinaryService $cloudinary)
    {
        // Verify technician owns this booking
        if ($booking->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $finishedDateRules = ['required', 'date', 'before_or_equal:today'];
        if ($booking->visit_date) {
            $finishedDateRules[] = 'after_or_equal:' . $booking->visit_date->toDateString();
        }

        $request->validate([
            'note' => 'nullable|string',
            'repair_finished_date' => $finishedDateRules,
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('proof_image')) {
            $imagePath = $cloudinary->upload(
                $request->file('proof_image'),
                config('services.cloudinary.repair_folder'),
                'booking_'.$booking->id.'_'.time()
            );
        }

        $booking->update([
            'status' => 'Repair Finished',
            'repair_finished_date' => $request->repair_finished_date,
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => 'Repair Finished',
            'description' => ($request->note ?? 'Technician has completed the repair work. Awaiting customer payment.')
                . ' Finished on ' . \Carbon\Carbon::parse($request->repair_finished_date)->format('d M Y') . '.',
            'status' => 'Completed',
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Repair marked as finished. Customer will now proceed with payment.');
    }

    public function storeAvailability(Request $request)
    {
        $request->validate([
            'unavailable_date' => 'required|date|after_or_equal:today',
            'unavailable_end_date' => 'nullable|date|after_or_equal:unavailable_date',
            'reason' => 'nullable|string|max:255',
        ]);

        TechnicianAvailability::create([
            'technician_id' => Auth::id(),
            'unavailable_date' => $request->unavailable_date,
            'unavailable_end_date' => $request->unavailable_end_date ?: $request->unavailable_date,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Unavailable date added successfully.');
    }

    public function updateAvailability(Request $request, TechnicianAvailability $availability)
    {
        if ($availability->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'unavailable_date' => 'required|date|after_or_equal:today',
            'unavailable_end_date' => 'nullable|date|after_or_equal:unavailable_date',
            'reason' => 'nullable|string|max:255',
        ]);

        $availability->update([
            'unavailable_date' => $request->unavailable_date,
            'unavailable_end_date' => $request->unavailable_end_date ?: $request->unavailable_date,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Availability updated successfully.');
    }

    public function deleteAvailability(TechnicianAvailability $availability)
    {
        if ($availability->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

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

        $booking->load([
            'customer',
            'device.repairs' => fn ($query) => $query->where('is_active', true),
            'timelines' => function($q) {
                $q->orderBy('created_at', 'desc');
            },
        ]);

        return view('technician.job-detail', compact('booking'));
    }
}
