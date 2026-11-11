<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class BodyMetric extends Model
{
    use HasFactory;

    protected $table = 'member_body_metrics';

    protected $fillable = [
        'user_id',
        'weight',
        'height',
        'body_fat_percentage',
        'muscle_mass_percentage',
        'water_percentage',
        'recorded_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'date',
            'weight' => 'decimal:2',
            'height' => 'decimal:2',
            'body_fat_percentage' => 'decimal:2',
            'muscle_mass_percentage' => 'decimal:2',
            'water_percentage' => 'decimal:2',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the user that owns this metric.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ==================== ACCESSORS ====================

    /**
     * Calculate and get BMI.
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->weight || !$this->height) {
            return null;
        }
        
        // Convert height from cm to meters
        $heightInMeters = $this->height / 100;
        
        // BMI = weight / height^2
        $bmi = $this->weight / ($heightInMeters * $heightInMeters);
        
        return round($bmi, 2);
    }

    /**
     * Get BMI category.
     */
    public function getBmiCategoryAttribute(): ?string
    {
        $bmi = $this->bmi;
        
        if ($bmi === null) {
            return null;
        }

        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    /**
     * Get BMI status color for UI.
     */
    public function getBmiColorAttribute(): string
    {
        $category = $this->bmi_category;
        
        return match($category) {
            'Normal' => 'green',
            'Underweight', 'Overweight' => 'yellow',
            'Obese' => 'red',
            default => 'gray',
        };
    }

    /**
     * Calculate ideal weight using Devine formula.
     */
    public function getIdealWeightAttribute(): ?float
    {
        if (!$this->height || !$this->user->gender) {
            return null;
        }

        // Convert height to inches
        $heightInInches = $this->height / 2.54;
        
        // Devine Formula
        if ($this->user->gender === 'male') {
            // Men: IBW (kg) = 50 + 2.3 × (height in inches - 60)
            $idealWeight = 50 + 2.3 * ($heightInInches - 60);
        } else {
            // Women: IBW (kg) = 45.5 + 2.3 × (height in inches - 60)
            $idealWeight = 45.5 + 2.3 * ($heightInInches - 60);
        }
        
        return round(max($idealWeight, 40), 2); // Minimum 40kg
    }

    /**
     * Get water percentage category.
     */
    public function getWaterCategoryAttribute(): ?string
    {
        if (!$this->water_percentage || !$this->user->gender) {
            return null;
        }

        $water = $this->water_percentage;
        
        if ($this->user->gender === 'male') {
            if ($water < 50) return 'Low';
            if ($water <= 65) return 'Normal';
            return 'High';
        } else {
            if ($water < 45) return 'Low';
            if ($water <= 60) return 'Normal';
            return 'High';
        }
    }

    /**
     * Get muscle mass category.
     */
    public function getMuscleCategoryAttribute(): ?string
    {
        if (!$this->muscle_mass_percentage || !$this->user->gender) {
            return null;
        }

        $muscle = $this->muscle_mass_percentage;
        
        if ($this->user->gender === 'male') {
            if ($muscle < 33) return 'Below Average';
            if ($muscle < 40) return 'Average';
            if ($muscle < 45) return 'Above Average';
            return 'Athlete';
        } else {
            if ($muscle < 25) return 'Below Average';
            if ($muscle < 31) return 'Average';
            if ($muscle < 36) return 'Above Average';
            return 'Athlete';
        }
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
     * Scope to get latest records first.
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('recorded_at', 'desc');
    }

    /**
     * Scope to get records for current month.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('recorded_at', now()->month)
                     ->whereYear('recorded_at', now()->year);
    }
}
