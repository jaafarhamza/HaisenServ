<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon_url',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'badge_user')
            ->withTimestamps()
            ->withPivot('earned_date');
    }

    public function assignBadge(User $user): void
    {
        if (!$this->users->contains($user->id)) {
            $this->users()->attach($user->id, ['earned_date' => now()]);
        }
    }

    public static function newUserBadge()
    {
        return self::firstOrCreate([
            'name' => 'New Member',
            'description' => 'Welcome to HaisenServ!',
            'icon_url' => '/badges/new-member.png',
        ]);
    }

    public static function firstBookingBadge()
    {
        return self::firstOrCreate([
            'name' => 'First Booking',
            'description' => 'Completed your first service booking',
            'icon_url' => '/badges/first-booking.png',
        ]);
    }

    public static function topRatedBadge()
    {
        return self::firstOrCreate([
            'name' => 'Top Rated',
            'description' => 'Achieved an average rating above 4.5',
            'icon_url' => '/badges/top-rated.png',
        ]);
    }
}