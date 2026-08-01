<?php

namespace App\Filament\Widgets\Stats;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class TransactionStatsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $pollingInterval = '120s';

    protected function getStats(): array
    {
        $pendingTransactions = Cache::remember('stats.pending_transactions', 300, function () {
            return Transaction::where('status', 'pending')->count();
        });
        
        $approvedThisMonth = Cache::remember('stats.approved_this_month', 300, function () {
            return Transaction::where('status', 'approved')
                ->whereYear('tanggal_transaksi', now()->year)
                ->whereMonth('tanggal_transaksi', now()->month)
                ->count();
        });

        return [
            Stat::make('Transaksi Menunggu', $pendingTransactions)
                ->description('Menunggu verifikasi')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->chart([1, 2, 3, 2, 4, 3, $pendingTransactions]),

            Stat::make('Disetujui Bulan Ini', $approvedThisMonth)
                ->description('Transaksi disetujui bulan ini')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success')
                ->chart([5, 8, 10, 12, 15, 18, $approvedThisMonth]),
        ];
    }
}
