<?php

namespace App\Filament\Widgets\Charts;

use App\Services\MembershipService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class RevenueByPaymentMethodWidget extends ChartWidget
{
    protected static ?string $heading = 'Metode Pembayaran';
    
    protected static ?int $sort = 3;
    
    protected static ?string $pollingInterval = '180s';

    protected static bool $isLazy = true;

    protected function getData(): array
    {
        $stats = Cache::remember('stats.revenue_by_method', 600, function () {
            $service = new MembershipService();
            return $service->getRevenueByPaymentMethod();
        });

        $labels = array_column($stats, 'label');
        $values = array_column($stats, 'count'); // Count of transactions, not value

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => $values,
                    'backgroundColor' => [
                        '#3b82f6', // transfer - blue
                        '#10b981', // cash - emerald
                        '#f59e0b', // qris - amber
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
