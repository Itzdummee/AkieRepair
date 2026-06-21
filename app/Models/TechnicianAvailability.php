<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicianAvailability extends Model
{
    protected $fillable = [
        'technician_id',
        'unavailable_date',
        'reason',
    ];

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}