<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
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
        'role',
        'membership_start_date',
        'membership_end_date',
        'status_aktif',
        'phone',
        'address',
        'gender',
        'birth_date',
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
            'membership_start_date' => 'date',
            'membership_end_date' => 'date',
            'birth_date' => 'date',
            'status_aktif' => 'boolean',
        ];
    }

    /**
     * Determine if the user can access Filament admin panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get all transactions for the user.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all member progress records for the user.
     */
    public function memberProgress(): HasMany
    {
        return $this->hasMany(MemberProgress::class);
    }

    /**
     * Get all transactions approved by this user (admin).
     */
    public function approvedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'approved_by');
    }

    /**
     * Get all body metrics for the user.
     */
    public function bodyMetrics(): HasMany
    {
        return $this->hasMany(BodyMetric::class);
    }

    /**
     * Get all custom workout types created by the user.
     */
    public function customWorkoutTypes(): HasMany
    {
        return $this->hasMany(CustomWorkoutType::class);
    }

    // ==================== HELPER METHODS ====================

    /**
     * Check if membership is currently active.
     */
    public function isMembershipActive(): bool
    {
        return $this->status_aktif && 
               $this->membership_end_date && 
               Carbon::today()->lte($this->membership_end_date);
    }

    /**
     * Check if membership has expired.
     */
    public function isMembershipExpired(): bool
    {
        if (!$this->membership_end_date) {
            return true;
        }
        return Carbon::today()->gt($this->membership_end_date);
    }

    /**
     * Get the number of days remaining in membership.
     */
    public function getDaysRemaining(): int
    {
        if (!$this->membership_end_date) {
            return 0;
        }
        $days = Carbon::today()->diffInDays($this->membership_end_date, false);
        return max(0, (int) $days);
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user can access Filament admin panel.
     */
    public function canAccessFilamentPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    /**
     * Check if user is a member.
     */
    public function isMember(): bool
    {
        return $this->role === 'member';
    }

    /**
     * Get the latest progress record.
     */
    public function getLatestProgress(): ?MemberProgress
    {
        return $this->memberProgress()->latest('tanggal')->first();
    }

    /**
     * Check if user has a pending transaction.
     */
    public function hasPendingTransaction(): bool
    {
        return $this->transactions()->where('status', 'pending')->exists();
    }

    // ==================== SCOPES ====================

    /**
     * Scope to get active members.
     */
    public function scopeActiveMembers(Builder $query): Builder
    {
        return $query->where('role', 'member')
                     ->where('status_aktif', true)
                     ->where('membership_end_date', '>=', Carbon::today());
    }

    /**
     * Scope to get expired members.
     */
    public function scopeExpiredMembers(Builder $query): Builder
    {
        return $query->where('role', 'member')
                     ->where(function ($q) {
                         $q->where('membership_end_date', '<', Carbon::today())
                           ->orWhereNull('membership_end_date');
                     });
    }
}
