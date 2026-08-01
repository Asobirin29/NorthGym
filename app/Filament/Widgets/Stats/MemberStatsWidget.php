<?php

namespace App\Filament\Widgets\Stats;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class MemberStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = '120s';

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        $totalMembers = Cache::remember('stats.total_members', 300, function () {
            return User::where('role', 'member')->count();
        });
        
        $activeMembers = Cache::remember('stats.active_members', 300, function () {
            return User::activeMembers()->count();
        });
        
        $expiredMembers = Cache::remember('stats.expired_members', 300, function () {
            return User::expiredMembers()->count();
        });

        return [
            Stat::make('Total Anggota', $totalMembers)
                ->description('Semua member terdaftar')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([5, 10, 15, 20, 25, 30, $totalMembers]),

            Stat::make('Anggota Aktif', $activeMembers)
                ->description('Membership masih aktif')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->chart([3, 7, 10, 12, 15, 18, $activeMembers]),

            Stat::make('Anggota Kedaluwarsa', $expiredMembers)
                ->description('Membership sudah berakhir')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger')
                ->chart([2, 3, 5, 8, 10, 12, $expiredMembers]),
        ];
    }
}
