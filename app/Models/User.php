<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Badge;
use App\Models\Rating;
use App\Models\Booking;
use App\Models\Message;
use App\Models\Category;
use App\Models\Gamification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'banned_until',
        'ban_reason',
        'phone',
        'bio',
        'city',
        'profile_completed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'banned_until' => 'datetime',
            'profile_completed' => 'boolean',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function hasPermission($permission): bool
    {
        return $this->roles->flatMap(function ($role) {
            return $role->permissions;
        })->contains('name', $permission);
    }

    public function assignRole($role): void
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }

    public function removeRole($role): void
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->detach($role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isBanned(): bool
    {
        return $this->banned_until !== null && $this->banned_until->isFuture();
    }

    public function getBanStatus(): string
    {
        if (!$this->isBanned()) {
            return 'Active';
        }

        if ($this->banned_until->isPast()) {
            return 'Ban Expired';
        }

        if ($this->banned_until->year === 2999) {
            return 'Permanently Banned';
        }

        return 'Banned until ' . $this->banned_until->format('M d, Y');
    }

    public function isProvider(): bool
    {
        return $this->hasRole('provider');
    }

    public function isClient(): bool
    {
        return $this->hasRole('client');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'user_category')
            ->select('categories.*');
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function sentMessages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

public function receivedMessages()
{
    return $this->hasMany(Message::class, 'recipient_id');
}

public function gamification()
{
    return $this->hasOne(Gamification::class);
}

public function badges()
{
    return $this->belongsToMany(Badge::class, 'badge_user')
        ->withTimestamps()
        ->withPivot('earned_date');
}
}