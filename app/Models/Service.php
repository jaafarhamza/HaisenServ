<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rating;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Availability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'price',
        'creation_date',
        'status',
        'meta_title',
        'meta_description',
        'slug',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image_url',
        'city',
    ];

    protected $casts = [
        'price' => 'float',
        'creation_date' => 'datetime',
    ];

    /**
     * Get the user that owns the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' $';
    }

    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'draft' => 'bg-gray-500',
            'pending' => 'bg-yellow-500',
            'active' => 'bg-green-500',
            'inactive' => 'bg-red-500',
            'rejected' => 'bg-red-700',
        ];

        return $classes[$this->status] ?? 'bg-gray-500';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'draft' => 'Draft',
            'pending' => 'Pending Approval',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'rejected' => 'Rejected',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function availabilities()
{
    return $this->hasMany(Availability::class);
}

public function updateAverageRating()
{
    $avgRating = $this->ratings()->avg('score') ?? 0;
    
    $this->user->rating_average = $avgRating;
    $this->user->save();
}
}