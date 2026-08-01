<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class WorkoutPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'media_path',
        'media_url',
        'kategori',
        'level',
        'durasi_menit',
        'kalori_estimasi',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'durasi_menit' => 'integer',
            'kalori_estimasi' => 'integer',
        ];
    }

    // ==================== ACCESSORS ====================

    /**
     * Get the full media URL (external URL or storage path).
     */
    public function getMediaUrlFullAttribute(): ?string
    {
        if ($this->media_url) {
            return $this->media_url;
        }
        if ($this->media_path) {
            return Storage::url($this->media_path);
        }
        return null;
    }

    /**
     * Get the badge color based on level.
     */
    public function getLevelBadgeColorAttribute(): string
    {
        return match($this->level) {
            'beginner' => 'success',
            'intermediate' => 'warning',
            'advanced' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get the badge color based on kategori.
     */
    public function getKategoriBadgeColorAttribute(): string
    {
        return match($this->kategori) {
            'cardio' => 'info',
            'strength' => 'danger',
            'flexibility' => 'success',
            'hiit' => 'warning',
            'endurance' => 'primary',
            default => 'secondary',
        };
    }

    // ==================== SCOPES ====================

    /**
     * Scope to get active workout plans.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by kategori.
     */
    public function scopeByKategori(Builder $query, string $kategori): Builder
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope to filter by level.
     */
    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }

    /**
     * Scope to get beginner level plans.
     */
    public function scopeBeginner(Builder $query): Builder
    {
        return $query->where('level', 'beginner');
    }

    /**
     * Scope to get intermediate level plans.
     */
    public function scopeIntermediate(Builder $query): Builder
    {
        return $query->where('level', 'intermediate');
    }

    /**
     * Scope to get advanced level plans.
     */
    public function scopeAdvanced(Builder $query): Builder
    {
        return $query->where('level', 'advanced');
    }
}
