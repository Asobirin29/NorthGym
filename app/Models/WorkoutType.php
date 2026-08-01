<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class WorkoutType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get progress records using this workout type.
     */
    public function progressRecords(): HasMany
    {
        return $this->hasMany(MemberProgress::class);
    }

    // ==================== SCOPES ====================

    /**
     * Scope to get only active workout types.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
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
