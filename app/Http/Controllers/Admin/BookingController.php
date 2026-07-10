<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingTimeline;
use App\Models\User;
use App\Models\TechnicianAvailability;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function pending()
    {
        $bookings = Booking::with(['customer', 'device', 'technician'])
            ->where('status', 'Visit Requested')
            ->latest()
            ->get();

        $technicians = User::with('availabilities')
            ->where('role', 'technician')
            ->where('approval_status', 'approved')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('admin.bookings-pending', compact('bookings', 'technicians'));
    }

    public function history()
    {
        $bookings = Booking::with(['customer', 'device', 'technician', 'repair'])
            ->whereNotIn('status', ['Visit Requested'])
            ->latest()
            ->get();

        return view('admin.bookings-history', compact('bookings'));
    }

    public function assignTechnician(Request $request, Booking $booking)
    {
        $request->validate([
            'technician_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where('role', 'technician')
                    ->where('approval_status', 'approved')
                    ->where('is_active', true),
            ],
        ]);

        $isUnavailable = TechnicianAvailability::where('technician_id', $request->technician_id)
            ->coveringDate($booking->visit_date)
            ->exists();

        if ($isUnavailable) {
            return back()->withErrors([
                'technician_id' => 'This technician is unavailable on the selected visit date.',
            ]);
        }

        $technician = User::findOrFail($request->technician_id);
        $deviceType = $booking->device->type ?? null;
        if ($deviceType) {
            $specialties = array_map('trim', explode(',', strtolower($technician->specialty ?? '')));
            $isSpecialized = false;
            foreach ($specialties as $specialty) {
                if (str_contains($specialty, strtolower($deviceType))) {
                    $isSpecialized = true;
                    break;
                }
            }
            
            if (!$isSpecialized) {
                return back()->withErrors([
                    'technician_id' => "This technician does not specialize in $deviceType.",
                ]);
            }
        }

        $booking->update([
            'technician_id' => $request->technician_id,
            'status' => 'Technician Assigned',
        ]);

        $alreadyExists = BookingTimeline::where('booking_id', $booking->id)
            ->where('title', 'Technician Assigned')
            ->exists();

        if (!$alreadyExists) {
            BookingTimeline::create([
                'booking_id' => $booking->id,
                'title' => 'Technician Assigned',
                'description' => 'Admin has assigned a technician for your site visit inspection.',
                'status' => 'Completed',
            ]);
        }

        return back()->with('success', 'Technician assigned successfully.');
    }

    public function quotation()
    {
        $bookings = Booking::with(['customer', 'device', 'technician', 'repair'])
            ->whereIn('status', ['Inspection Completed', 'Quotation Sent'])
            ->latest()
            ->get();

        return view('admin.bookings-quotation', compact('bookings'));
    }

    public function sendQuotation(Request $request, Booking $booking)
    {
        $request->validate([
            'quotation_note' => 'nullable|string',
        ]);

        $booking->update([
            'quotation_note' => $request->quotation_note,
            'quotation_status' => 'Pending Customer Approval',
            'status' => 'Quotation Sent',
        ]);

        // Auto-generate PDF on send — trim spaces from each name to avoid mismatch
        $repairNames = array_filter(array_map('trim', explode(',', $booking->inspection_report ?? '')));
        $repairs = \App\Models\Repair::whereIn('repair_type', $repairNames)
            ->where('device_id', $booking->device_id)
            ->where('is_active', true)
            ->get();

        $pdf = Pdf::loadView('admin.quotation-pdf', [
            'booking' => $booking,
            'repairs' => $repairs,
        ]);

        $fileName = 'quotation-booking-' . $booking->id . '.pdf';
        Storage::makeDirectory('public/quotations');
        Storage::put('public/quotations/' . $fileName, $pdf->output());

        $booking->update([
            'quotation_pdf' => 'storage/quotations/' . $fileName,
        ]);

        // Add timeline entry
        $alreadyExists = \App\Models\BookingTimeline::where('booking_id', $booking->id)
            ->where('title', 'Quotation Sent')
            ->exists();

        if (!$alreadyExists) {
            \App\Models\BookingTimeline::create([
                'booking_id' => $booking->id,
                'title' => 'Quotation Sent',
                'description' => 'Admin has reviewed the inspection report and sent a repair quotation.',
                'status' => 'Completed',
            ]);
        }

        return back()->with('success', 'Quotation sent to customer successfully.');
    }
    public function generateQuotationPdf(Request $request, Booking $booking)
    {
        if ($request->has('note')) {
            $booking->quotation_note = $request->input('note');
        }

        // Trim each repair name to avoid whitespace mismatch from comma-separated string
        $repairNames = array_filter(array_map('trim', explode(',', $booking->inspection_report ?? '')));

        $repairs = \App\Models\Repair::whereIn('repair_type', $repairNames)
            ->where('device_id', $booking->device_id)
            ->where('is_active', true)
            ->get();

        $pdf = Pdf::loadView('admin.quotation-pdf', [
            'booking' => $booking,
            'repairs' => $repairs,
        ]);

        return $pdf->stream('quotation-preview.pdf');
    }
}
