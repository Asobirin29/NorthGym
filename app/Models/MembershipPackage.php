<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class MembershipPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration_months',
        'price',
        'discount_percentage',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_percentage' => 'decimal:2',
            'is_active' => 'boolean',
            'duration_months' => 'integer',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get all transactions using this package.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // ==================== ACCESSORS ====================

    /**
     * Get formatted price with currency.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get discounted price if discount exists.
     */
    public function getDiscountedPriceAttribute(): float
    {
        if (!$this->discount_percentage) {
            return (float) $this->price;
        }

        $discount = ($this->price * $this->discount_percentage) / 100;
        return (float) ($this->price - $discount);
    }

    /**
     * Get formatted discounted price.
     */
    public function getFormattedDiscountedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->discounted_price, 0, ',', '.');
    }

    /**
     * Get price per month.
     */
    public function getPricePerMonthAttribute(): float
    {
        return (float) ($this->discounted_price / $this->duration_months);
    }

    /**
     * Get formatted price per month.
     */
    public function getFormattedPricePerMonthAttribute(): string
    {
        return 'Rp ' . number_format($this->price_per_month, 0, ',', '.') . ' / bulan';
    }

    // ==================== SCOPES ====================

    /**
     * Scope to get only active packages.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by duration.
     */
    public function scopeOrderByDuration(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy('duration_months', $direction);
    }

    /**
     * Scope to order by price.
     */
    public function scopeOrderByPrice(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy('price', $direction);
    }

    // ==================== HELPER METHODS ====================

    /**
     * Check if package has discount.
     */
    public function hasDiscount(): bool
    {
        return $this->discount_percentage > 0;
    }

    /**
     * Get discount amount in currency.
     */
    public function getDiscountAmount(): float
    {
        if (!$this->discount_percentage) {
            return 0;
        }

        return (float) (($this->price * $this->discount_percentage) / 100);
    }

    /**
     * Get savings compared to monthly price.
     */
    public function getSavingsVsMonthly(float $monthlyPrice): float
    {
        $totalMonthlyPrice = $monthlyPrice * $this->duration_months;
        return (float) ($totalMonthlyPrice - $this->discounted_price);
    }
}
