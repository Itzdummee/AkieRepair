<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TechnicianAvailability extends Model
{
    protected $fillable = [
        'technician_id',
        'unavailable_date',
        'unavailable_end_date',
        'reason',
    ];

    protected $casts = [
        'unavailable_date' => 'date',
        'unavailable_end_date' => 'date',
    ];

    public function getDisplayDateRangeAttribute(): string
    {
        $startDate = Carbon::parse($this->unavailable_date);
        $endDate = $this->unavailable_end_date
            ? Carbon::parse($this->unavailable_end_date)
            : $startDate;

        if ($startDate->isSameDay($endDate)) {
            return $startDate->format('j/n');
        }

        return $startDate->format('j/n') . '-' . $endDate->format('j/n');
    }

    public function isUnavailableOn($date): bool
    {
        $visitDate = Carbon::parse($date);
        $startDate = Carbon::parse($this->unavailable_date)->startOfDay();
        $endDate = $this->unavailable_end_date
            ? Carbon::parse($this->unavailable_end_date)->endOfDay()
            : Carbon::parse($this->unavailable_date)->endOfDay();

        return $visitDate->betweenIncluded($startDate, $endDate);
    }

    public function scopeCoveringDate($query, $date)
    {
        return $query
            ->whereDate('unavailable_date', '<=', $date)
            ->where(function ($query) use ($date) {
                $query->whereDate('unavailable_end_date', '>=', $date)
                    ->orWhere(function ($query) use ($date) {
                        $query->whereNull('unavailable_end_date')
                            ->whereDate('unavailable_date', $date);
                    });
            });
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
