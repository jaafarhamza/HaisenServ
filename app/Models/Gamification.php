<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gamification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'level',
        'update_date',
    ];

    protected $casts = [
        'update_date' => 'datetime',
        'points' => 'integer',
        'level' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addPoints(int $points): void
    {
        $this->points += $points;
        $this->update_date = now();
        $this->save();
        
        // Check if user should level up
        $this->checkLevelUp();
    }

    public function levelUp(): void
    {
        $this->level += 1;
        $this->update_date = now();
        $this->save();
        
        // You could trigger events here like badge assignments
    }

    private function checkLevelUp(): void
    {
        // Define level thresholds (example: level 1 = 0-100 points, level 2 = 101-300 points, etc.)
        $thresholds = [
            1 => 0,
            2 => 100,
            3 => 300,
            4 => 600,
            5 => 1000,
            // Add more levels as needed
        ];
        
        // Find the highest level the user qualifies for
        $newLevel = 1;
        foreach ($thresholds as $level => $threshold) {
            if ($this->points >= $threshold) {
                $newLevel = $level;
            } else {
                break;
            }
        }
        
        // Level up if needed
        if ($newLevel > $this->level) {
            $this->level = $newLevel;
            $this->save();
        }
    }
}