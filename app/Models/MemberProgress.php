<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkoutType;
use App\Models\CustomWorkoutType;

class MemberProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member_progress';

    protected $fillable = [
        'user_id',
        'tanggal',
        'berat_badan',
        'tinggi_badan',
        'lingkar_perut',
        'lingkar_dada',
        'lingkar_lengan',
        'body_fat_percentage',
        'muscle_mass_percentage',
        'water_percentage',
        'foto_before_path',
        'foto_after_path',
        'catatan',
        'workout_type_id',
        'custom_workout_type_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'berat_badan' => 'decimal:2',
            'tinggi_badan' => 'decimal:2',
            'body_fat_percentage' => 'decimal:2',
            'muscle_mass_percentage' => 'decimal:2',
            'water_percentage' => 'decimal:2',
            'lingkar_perut' => 'decimal:2',
            'lingkar_dada' => 'decimal:2',
            'lingkar_lengan' => 'decimal:2',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the user that owns this progress record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the workout type for this progress.
     */
    public function workoutType(): BelongsTo
    {
        return $this->belongsTo(WorkoutType::class);
    }

    /**
     * Get the custom workout type for this progress.
     */
    public function customWorkoutType(): BelongsTo
    {
        return $this->belongsTo(CustomWorkoutType::class);
    }

    // ==================== ACCESSORS ====================

    /**
     * Get the URL for before photo.
     */
    public function getFotoBeforeUrlAttribute(): ?string
    {
        if (!$this->foto_before_path) {
            return null;
        }
        return Storage::url($this->foto_before_path);
    }

    /**
     * Get the URL for after photo.
     */
    public function getFotoAfterUrlAttribute(): ?string
    {
        if (!$this->foto_after_path) {
            return null;
        }
        return Storage::url($this->foto_after_path);
    }

    /**
     * Calculate and get BMI.
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->berat_badan || !$this->tinggi_badan) {
            return null;
        }
        
        // Convert height from cm to meters
        $heightInMeters = $this->tinggi_badan / 100;
        
        // BMI = weight / height^2
        $bmi = $this->berat_badan / ($heightInMeters * $heightInMeters);
        
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
            return 'Kurus';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Berat Berlebih';
        } else {
            return 'Obesitas';
        }
    }

    /**
     * Get workout type name (either default or custom).
     */
    public function getWorkoutTypeNameAttribute(): ?string
    {
        if ($this->customWorkoutType) {
            return $this->customWorkoutType->name;
        }
        
        if ($this->workoutType) {
            return $this->workoutType->name;
        }
        
        return null;
    }

    /**
     * Calculate ideal weight using Devine formula.
     */
    public function getIdealWeightAttribute(): ?float
    {
        if (!$this->tinggi_badan || !$this->user->gender) {
            return null;
        }

        return \App\Services\BodyMetricsCalculator::calculateIdealWeight(
            $this->tinggi_badan,
            $this->user->gender
        );
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
        return $query->orderBy('tanggal', 'desc');
    }

    /**
     * Scope to get records for current month.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('tanggal', now()->month)
                     ->whereYear('tanggal', now()->year);
    }
}
