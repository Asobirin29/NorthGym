<?php

namespace App\Filament\Widgets\Stats;

use App\Models\Transaction;
use App\Services\MembershipService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class RevenueStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $pollingInterval = '120s';

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        $service = new MembershipService();
        $stats = $service->getRevenueStats();
        
        $pnlColor = $stats['growth'] >= 0 ? 'success' : 'danger';
        $pnlIcon = $stats['growth'] >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';

        return [
            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($stats['current_month'], 0, ',', '.'))
                ->description($stats['growth'] . '% dari bulan lalu')
                ->descriptionIcon($pnlIcon)
                ->color($pnlColor),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($stats['total'], 0, ',', '.'))
                ->description('Total pendapatan keseluruhan')
                ->color('primary'),
                
            Stat::make('Rata-rata Transaksi', 'Rp ' . number_format($stats['avg_transaction_value'], 0, ',', '.'))
                ->description('Nilai rata-rata transaksi')
                ->color('info'),
        ];
    }
}
