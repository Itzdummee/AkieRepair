<?php

namespace App\Mail;

use App\Models\BookingTimeline;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingTimelineUpdatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public BookingTimeline $timeline;
    public string $recipientRole;

    public function __construct(BookingTimeline $timeline, string $recipientRole)
    {
        $this->timeline = $timeline;
        $this->recipientRole = $recipientRole;
    }

    public function build()
    {
        $roleLabel = match ($this->recipientRole) {
            'customer' => 'Customer',
            'technician' => 'Technician',
            default => 'Admin',
        };

        return $this->subject('Booking #' . $this->timeline->booking_id . ' - ' . $this->timeline->title)
            ->view('emails.booking.timeline-updated')
            ->with([
                'timeline' => $this->timeline,
                'recipientRole' => $roleLabel,
                'booking' => $this->timeline->booking,
            ]);
    }
}