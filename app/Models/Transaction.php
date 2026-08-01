<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_package_id',
        'nominal',
        'bukti_transfer_path',
        'status',
        'payment_method',
        'tanggal_transaksi',
        'durasi_bulan',
        'catatan_admin',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
            'tanggal_transaksi' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the user that owns the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved/rejected the transaction.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the membership package for this transaction.
     */
    public function membershipPackage(): BelongsTo
    {
        return $this->belongsTo(MembershipPackage::class);
    }

    // ==================== ACCESSORS ====================

    /**
     * Get the full URL of the payment proof.
     */
    public function getBuktiTransferUrlAttribute(): ?string
    {
        if (!$this->bukti_transfer_path) {
            return null;
        }
        return Storage::url($this->bukti_transfer_path);
    }

    /**
     * Get the badge color based on status.
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get the payment method label in Indonesian.
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'transfer' => 'Transfer Bank',
            'cash' => 'Tunai',
            'qris' => 'QRIS',
            default => 'Unknown',
        };
    }

    /**
     * Get the badge color for payment method.
     */
    public function getPaymentMethodBadgeColorAttribute(): string
    {
        return match($this->payment_method) {
            'transfer' => 'info',
            'cash' => 'success',
            'qris' => 'warning',
            default => 'secondary',
        };
    }

    // ==================== HELPER METHODS ====================

    /**
     * Check if transaction is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if transaction is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if transaction is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    // ==================== SCOPES ====================

    /**
     * Scope to get pending transactions.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get approved transactions.
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get rejected transactions.
     */
    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope to get transactions for current month.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('tanggal_transaksi', now()->month)
                     ->whereYear('tanggal_transaksi', now()->year);
    }
}
