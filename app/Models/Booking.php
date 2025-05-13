<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Rating;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'status',
        'amount',
        'creation_date',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'creation_date' => 'datetime',
        'amount' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function confirm(): void
    {
        $this->status = 'confirmed';
        $this->save();
    }

    public function cancel(): void
    {
        $this->status = 'cancelled';
        $this->save();
    }

    public function complete(): void
    {
        $this->status = 'completed';
        $this->save();
    }

    public function checkAvailability(): bool
    {
        // Check if the service is available at the requested time
        // This will use the Availability model to check for conflicts
        return $this->service->checkAvailability($this->booking_date);
    }

    /**
     * Check if this booking has a rating from the user.
     */
    public function hasRating(): bool
    {
        return $this->user->ratings()->where('service_id', $this->service_id)->exists();
    }
    
    /**
     * Get the rating for this booking.
     */
    public function rating()
    {
        // Changed to return a relationship instance instead of a model
        return $this->hasOne(Rating::class, 'service_id', 'service_id')
            ->where('user_id', $this->user_id);
    }
    
    /**
     * Get the rating model for this booking (helper method).
     */
    public function getRatingAttribute()
    {
        return $this->rating()->first();
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}