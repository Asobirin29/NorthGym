<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\Stats\MemberStatsWidget;
use App\Filament\Widgets\Stats\RevenueStatsWidget;
use App\Filament\Widgets\Stats\TransactionStatsWidget;
use App\Filament\Widgets\Charts\MonthlyRevenueChart;
use App\Filament\Widgets\Lists\LatestMembersWidget;
use App\Filament\Widgets\Lists\RecentProgressWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $title = 'Dashboard Admin';
    
    protected static ?string $navigationLabel = 'Dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            MemberStatsWidget::class,
            RevenueStatsWidget::class,
            TransactionStatsWidget::class,
            MonthlyRevenueChart::class,
            LatestMembersWidget::class,
            RecentProgressWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }
}
