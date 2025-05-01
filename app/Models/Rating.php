<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'score',
        'comment',
        'rating_date',
        'reply_id',
    ];

    protected $casts = [
        'rating_date' => 'datetime',
        'score' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function parentRating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'reply_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Rating::class, 'reply_id');
    }

    public function updateRating(): void
    {
        // Update the rating
        $this->save();
        
        // Update the service average rating
        $this->service->updateAverageRating();
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('reply_id');
    }
}