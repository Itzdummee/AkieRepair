<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeAppliance extends Model
{
    protected $fillable = [
        'device_id',
        'appliance_type',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}