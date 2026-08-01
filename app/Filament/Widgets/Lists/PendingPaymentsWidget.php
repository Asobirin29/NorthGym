<?php

namespace App\Filament\Widgets\Lists;

use App\Models\Transaction;
use App\Services\MembershipService;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class PendingPaymentsWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    
    protected int|string|array $columnSpan = 'full';
    
    protected static ?string $heading = 'Verifikasi Pembayaran Menunggu';
    
    protected static ?string $pollingInterval = null;

    protected static bool $isLazy = true;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()->pending()->latest()->with(['user', 'membershipPackage'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Anggota')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('membershipPackage.name')
                    ->label('Paket')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'transfer' => 'info',
                        'cash' => 'success',
                        'qris' => 'warning',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('nominal')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('tanggal_transaksi')
                    ->date('d M Y'),
                    
                Tables\Columns\ImageColumn::make('bukti_transfer_path')
                    ->label('Bukti')
                    ->circular(),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Transaction $record) {
                        $service = new MembershipService();
                        $service->approveMembership($record, Auth::id());
                        
                        Notification::make()
                            ->success()
                            ->title('Pembayaran Disetujui')
                            ->send();
                    }),
            ]);
    }
}
