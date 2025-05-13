<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function isAvailable($startTime, $endTime = null): bool
    {
        
        if (!$endTime) {
            return $startTime >= $this->start_time && $startTime <= $this->end_time;
        }
        
        return $startTime >= $this->start_time && $endTime <= $this->end_time;
    }

    public function hasConflictWithBooking(Booking $booking): bool
    {
        $bookingDate = $booking->booking_date;
        
        return $this->isAvailable($bookingDate);
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('start_time', $date->toDateString());
    }
}