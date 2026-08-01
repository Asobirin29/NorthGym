<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ==================== SCOPES ====================

    /**
     * Scope to get only active bank details.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
