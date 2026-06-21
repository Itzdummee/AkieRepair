<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_type',
        'admin_id',
    ];

    public function repairs()
    {
    return $this->hasMany(Repair::class);
    }
}