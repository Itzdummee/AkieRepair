<?php

namespace App\Models;

use App\Mail\BookingTimelineUpdatedMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

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
            self::sendTimelineEmailAfterResponse($timeline->id, $recipient['email'], $recipient['role']);
        }
    }

    protected static function sendTimelineEmailAfterResponse(int $timelineId, string $email, string $role): void
    {
        dispatch(function () use ($timelineId, $email, $role) {
            try {
                $timeline = self::with(['booking.customer', 'booking.technician'])->find($timelineId);

                if (! $timeline) {
                    return;
                }

                Mail::to($email)->send(new BookingTimelineUpdatedMail($timeline, $role));
            } catch (Throwable $e) {
                Log::error('Booking timeline email notification failed for ' . $email . ': ' . $e->getMessage());
            }
        })->afterResponse();
    }
}
