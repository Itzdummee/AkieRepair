<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingReview extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
