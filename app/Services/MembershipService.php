<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Models\MembershipPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MembershipService
{
    /**
     * Approve a membership transaction and update user membership.
     */
    public function approveMembership(Transaction $transaction, int $approvedBy): bool
    {
        return DB::transaction(function () use ($transaction, $approvedBy) {
            $user = $transaction->user;

            // Calculate new end date
            $newEndDate = $this->calculateNewMembershipEndDate($user, $transaction->durasi_bulan);

            // Update user membership
            $user->update([
                'membership_start_date' => $user->membership_start_date ?? Carbon::today(),
                'membership_end_date' => $newEndDate,
                'status_aktif' => true,
            ]);

            // Update transaction status
            $transaction->update([
                'status' => 'approved',
                'approved_by' => $approvedBy,
                'approved_at' => now(),
            ]);

            // Clear relevant caches after approval
            $this->clearRelatedCaches();

            return true;
        });
    }

    /**
     * Calculate new membership end date based on current status.
     */
    public function calculateNewMembershipEndDate(User $user, int $durasiBulan): Carbon
    {
        // If user has active membership, extend from current end date
        if ($user->membership_end_date && Carbon::today()->lte($user->membership_end_date)) {
            return Carbon::parse($user->membership_end_date)->addMonths($durasiBulan);
        }

        // If expired or new, start from today
        return Carbon::today()->addMonths($durasiBulan);
    }

    /**
     * Check and update expired memberships.
     * Returns the number of memberships that were updated.
     */
    public function checkAndUpdateExpiredMemberships(): int
    {
        return User::where('role', 'member')
            ->where('status_aktif', true)
            ->where('membership_end_date', '<', Carbon::today())
            ->update(['status_aktif' => false]);
    }

    /**
     * Get membership statistics.
     */
    public function getMembershipStats(): array
    {
        $activeMembers = User::activeMembers()->count();
        $expiredMembers = User::expiredMembers()->count();
        $expiringIn7Days = User::where('role', 'member')
            ->where('status_aktif', true)
            ->whereBetween('membership_end_date', [Carbon::today(), Carbon::today()->addDays(7)])
            ->count();

        return [
            'active' => $activeMembers,
            'expired' => $expiredMembers,
            'expiring_soon' => $expiringIn7Days,
            'total' => $activeMembers + $expiredMembers,
        ];
    }

    /**
     * Get expanded revenue statistics.
     */
    /**
     * Get expanded revenue statistics.
     */
    public function getRevenueStats(): array
    {
        return Cache::rememberForever('stats.revenue_stats_expanded', function () {
            $currentMonth = now()->month;
            $currentYear = now()->year;
            $lastMonth = now()->subMonth();

            $currentMonthRevenue = Transaction::approved()
                ->whereMonth('tanggal_transaksi', $currentMonth)
                ->whereYear('tanggal_transaksi', $currentYear)
                ->sum('nominal');

            $lastMonthRevenue = Transaction::approved()
                ->whereMonth('tanggal_transaksi', $lastMonth->month)
                ->whereYear('tanggal_transaksi', $lastMonth->year)
                ->sum('nominal');

            $totalRevenue = Transaction::approved()->sum('nominal');
            $transactionCount = Transaction::approved()->count();
            $avgTransactionValue = $transactionCount > 0 ? $totalRevenue / $transactionCount : 0;

            // Calculate growth
            $growth = 0;
            if ($lastMonthRevenue > 0) {
                $growth = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
            }

            return [
                'current_month' => $currentMonthRevenue,
                'last_month' => $lastMonthRevenue,
                'total' => $totalRevenue,
                'growth' => round($growth, 1),
                'avg_transaction_value' => $avgTransactionValue,
            ];
        });
    }

    /**
     * Get revenue breakdown by package.
     */
    public function getRevenueByPackage(?string $startDate = null, ?string $endDate = null): array
    {
        $query = Transaction::approved()
            ->select('membership_package_id', DB::raw('sum(nominal) as total'), DB::raw('count(*) as count'))
            ->groupBy('membership_package_id')
            ->with('membershipPackage');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        $results = $query->get();
        
        return $results->map(function ($item) {
            return [
                'name' => $item->membershipPackage ? $item->membershipPackage->name : 'Custom/Legacy',
                'value' => (float) $item->total,
                'count' => $item->count,
            ];
        })->toArray();
    }

    /**
     * Get revenue breakdown by payment method.
     */
    public function getRevenueByPaymentMethod(?string $startDate = null, ?string $endDate = null): array
    {
        $query = Transaction::approved()
            ->select('payment_method', DB::raw('sum(nominal) as total'), DB::raw('count(*) as count'))
            ->groupBy('payment_method');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        return $query->get()->map(function ($item) {
            return [
                'method' => $item->payment_method ?? 'unknown',
                'label' => match($item->payment_method) {
                    'transfer' => 'Transfer Bank',
                    'cash' => 'Tunai',
                    'qris' => 'QRIS',
                    default => 'Lainnya',
                },
                'value' => (float) $item->total,
                'count' => $item->count,
            ];
        })->toArray();
    }

    /**
     * Get monthly revenue trend for specific year.
     */
    public function getMonthlyRevenueTrend(int $year): array
    {
        $monthlyStats = Transaction::approved()
            ->whereYear('tanggal_transaksi', $year)
            ->select(
                DB::raw('MONTH(tanggal_transaksi) as month'), 
                DB::raw('SUM(nominal) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Fill missing months with 0
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = (float) ($monthlyStats[$i] ?? 0);
        }

        return $data;
    }

    /**
     * Clear all related caches after membership changes.
     */
    private function clearRelatedCaches(): void
    {
        // Clear navigation badge cache
        Cache::forget('pending_transactions_count');
        
        // Clear all widget stats caches
        Cache::forget('stats.total_members');
        Cache::forget('stats.active_members');
        Cache::forget('stats.expired_members');
        Cache::forget('stats.pending_transactions');
        Cache::forget('stats.approved_this_month');
        Cache::forget('stats.revenue_current_month');
        Cache::forget('stats.revenue_total');
        
        // Clear chart cache (monthly revenue will update on next load)
        Cache::forget('chart.monthly_revenue');
        Cache::forget('stats.revenue_by_package');
        Cache::forget('stats.revenue_by_method');
        Cache::forget('stats.revenue_stats_expanded');
    }
}
