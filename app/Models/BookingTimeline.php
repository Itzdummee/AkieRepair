<?php

namespace App\Models;

use App\Mail\BookingTimelineUpdatedMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingTimeline extends Model
{
    protected $fillable = [
        'booking_id',
        'title',
        'description',
        'status',
        'image',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    protected static function booted()
    {
        static::created(function ($timeline) {
            self::sendEmailNotifications($timeline);
        });
    }

    protected static function sendEmailNotifications($timeline)
    {
        $timeline->loadMissing(['booking.customer', 'booking.technician']);

        if (! $timeline->booking) {
            return;
        }

        $recipients = [];

        if ($timeline->booking->customer && ! empty($timeline->booking->customer->email)) {
            $recipients[] = [
                'email' => $timeline->booking->customer->email,
                'role' => 'customer',
            ];
        }

        if ($timeline->booking->technician && ! empty($timeline->booking->technician->email)) {
            $recipients[] = [
                'email' => $timeline->booking->technician->email,
                'role' => 'technician',
            ];
        }

        $admins = User::where('role', 'admin')
            ->whereNotNull('email')
            ->get();

        foreach ($admins as $admin) {
            if (! empty($admin->email)) {
                $recipients[] = [
                    'email' => $admin->email,
                    'role' => 'admin',
                ];
            }
        }

        foreach ($recipients as $recipient) {
            try {
                Mail::to($recipient['email'])
                    ->queue(new BookingTimelineUpdatedMail($timeline, $recipient['role']));
            } catch (\Exception $e) {
                Log::error('Booking timeline email notification failed for ' . $recipient['email'] . ': ' . $e->getMessage());
            }
        }
    }
}