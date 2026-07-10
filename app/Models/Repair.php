<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = [
        'service_id',
        'device_id',
        'repair_type',
        'description',
        'price',
        'warranty_period',
        'duration',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
