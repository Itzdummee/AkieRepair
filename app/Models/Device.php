<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'type',
        'model',
        'capacity',
        'capacity_unit',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function repairs()
    {
    return $this->hasMany(Repair::class);
    }
}
