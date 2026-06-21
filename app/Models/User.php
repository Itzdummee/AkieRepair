<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone_number',
        'role',
        'password',

        'approval_status',
        'email_verified_at',
        'specialty',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function availabilities()
    {
    return $this->hasMany(\App\Models\TechnicianAvailability::class, 'technician_id');
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'customer_id');
    }

    public function assignedBookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'technician_id');
    }
}