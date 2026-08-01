<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class CustomWorkoutType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
    ];

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the user that owns this custom workout type.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get progress records using this custom workout type.
     */
    public function progressRecords(): HasMany
    {
        return $this->hasMany(MemberProgress::class);
    }

    // ==================== SCOPES ====================

    /**
     * Scope to filter by user.
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to filter by category.
     */
    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    // ==================== ACCESSORS ====================

    /**
     * Get category icon.
     */
    public function getCategoryIconAttribute(): string
    {
        return match($this->category) {
            'cardio' => '🏃',
            'strength' => '💪',
            'flexibility' => '🧘',
            default => '🏋️',
        };
    }

    /**
     * Get category color.
     */
    public function getCategoryColorAttribute(): string
    {
        return match($this->category) {
            'cardio' => 'blue',
            'strength' => 'red',
            'flexibility' => 'green',
            default => 'gray',
        };
    }
}
