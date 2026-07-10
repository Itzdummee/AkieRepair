<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingReview;
use App\Models\BookingTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        $this->authorizeReviewAccess($booking);

        if ($booking->review) {
            return redirect()
                ->route('customer.booking.show', $booking->id)
                ->with('success', 'You already reviewed this repair service.');
        }

        $booking->load(['device', 'technician', 'timelines' => fn ($query) => $query->latest()]);

        return view('customer.review-create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $this->authorizeReviewAccess($booking);

        if ($booking->review) {
            return redirect()
                ->route('customer.booking.show', $booking->id)
                ->with('success', 'You already reviewed this repair service.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        BookingReview::create([
            'booking_id' => $booking->id,
            'customer_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        BookingTimeline::create([
            'booking_id' => $booking->id,
            'title' => 'Customer Review Added',
            'description' => 'Customer rated the repair service ' . $validated['rating'] . ' out of 5 stars.',
            'status' => 'Completed',
        ]);

        return redirect()
            ->route('customer.booking.history')
            ->with('success', 'Thank you for rating our repair service.');
    }

    private function authorizeReviewAccess(Booking $booking): void
    {
        if ($booking->customer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($booking->payment_status !== 'Paid' || $booking->status !== 'Repair Completed') {
            abort(403, 'You can review this repair after payment is completed.');
        }
    }
}
