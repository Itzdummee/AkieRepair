<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'device_id',
        'repair_id',
        'technician_id',
        'problem_description',
        'visit_date',
        'inspection_report',
        'quotation_price',
        'quotation_note',
        'quotation_status',
        'quotation_pdf',
        'pickup_date',
        'status',
        'payment_status',
        'amount_paid',
        'payment_session_id',
        'payment_date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function timelines()
    {
        return $this->hasMany(BookingTimeline::class);
    }
    
    public function repair()
    {
    return $this->belongsTo(Repair::class);
    }
}