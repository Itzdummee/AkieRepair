<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    protected $fillable = [
        'device_id',
        'operating_system',
        'storage',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}