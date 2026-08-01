<?php

namespace App\Filament\Resources\Membership;

use App\Filament\Resources\Membership\TransactionResource\Pages;
use App\Models\Transaction;
use App\Models\MembershipPackage;
use App\Services\MembershipService;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Transaksi Pembayaran';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Transaksi')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Member')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabled(fn ($record) => $record !== null),

                        Forms\Components\Select::make('membership_package_id')
                            ->label('Paket Membership')
                            ->options(MembershipPackage::active()->orderByDuration()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $package = MembershipPackage::find($state);
                                    if ($package) {
                                        $set('nominal', $package->discounted_price);
                                        $set('durasi_bulan', $package->duration_months);
                                    }
                                }
                            })
                            ->required(fn ($record) => $record === null),

                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'transfer' => 'Transfer Bank',
                                'cash' => 'Tunai (Cash)',
                                'qris' => 'QRIS',
                            ])
                            ->default('transfer')
                            ->required(),

                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal Pembayaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_transaksi')
                            ->label('Tanggal Transaksi')
                            ->required()
                            ->default(now()),

                        Forms\Components\Hidden::make('durasi_bulan')
                            ->default(1),
                            
                        Forms\Components\TextInput::make('durasi_display')
                            ->label('Durasi Membership')
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(fn ($get) => $get('durasi_bulan') ? $get('durasi_bulan') . ' Bulan' : '-'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Bukti Transfer')
                    ->schema([
                        Forms\Components\FileUpload::make('bukti_transfer_path')
                            ->label('Upload Bukti Transfer')
                            ->image()
                            ->maxSize(5120)
                            ->directory('bukti-transfer')
                            ->imageEditor()
                            ->required(fn ($get) => $get('payment_method') === 'transfer')
                            ->visible(fn ($get) => $get('payment_method') !== 'cash'),
                    ]),

                Forms\Components\Section::make('Status & Catatan Admin')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->default('pending')
                            ->required()
                            ->disabled(),

                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->placeholder('Isi jika reject atau ada catatan khusus'),
                    ])
                    ->hidden(fn ($record) => $record === null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('membershipPackage.name')
                    ->label('Paket')
                    ->badge()
                    ->color('info')
                    ->placeholder('Custom/Legacy'),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'transfer' => 'Transfer',
                        'cash' => 'Tunai',
                        'qris' => 'QRIS',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'transfer' => 'info',
                        'cash' => 'success',
                        'qris' => 'warning',
                        default => 'secondary',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'transfer' => 'heroicon-m-credit-card',
                        'cash' => 'heroicon-m-currency-dollar',
                        'qris' => 'heroicon-m-qr-code',
                        default => 'heroicon-m-question-mark-circle',
                    }),

                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'secondary',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'approved' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('approver.name')
                    ->label('Disetujui Oleh')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->default('pending'),
                
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'transfer' => 'Transfer Bank',
                        'cash' => 'Tunai',
                        'qris' => 'QRIS',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_transaksi', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_transaksi', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('view_proof')
                    ->label('Bukti')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading('Bukti Transfer')
                    ->modalContent(fn (Transaction $record) => view('filament.modals.view-payment-proof', ['transaction' => $record]))
                    ->visible(fn (Transaction $record) => $record->payment_method === 'transfer' && $record->bukti_transfer_path)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),

                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Pembayaran')
                    ->modalDescription(fn (Transaction $record) => 
                        "Setujui pembayaran dari {$record->user->name} sebesar Rp " . 
                        number_format($record->nominal, 0, ',', '.') . 
                        " untuk {$record->durasi_bulan} bulan?"
                    )
                    ->action(function (Transaction $record, MembershipService $membershipService) {
                        $membershipService->approveMembership($record, Auth::id());

                        Notification::make()
                            ->success()
                            ->title('Pembayaran Disetujui')
                            ->body("Membership {$record->user->name} telah diperpanjang {$record->durasi_bulan} bulan")
                            ->send();
                    })
                    ->visible(fn (Transaction $record) => $record->status === 'pending'),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Jelaskan alasan reject pembayaran ini...'),
                    ])
                    ->action(function (Transaction $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'catatan_admin' => $data['catatan_admin'],
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                        ]);

                        Notification::make()
                            ->warning()
                            ->title('Pembayaran Ditolak')
                            ->body("Pembayaran dari {$record->user->name} telah ditolak")
                            ->send();
                    })
                    ->visible(fn (Transaction $record) => $record->status === 'pending'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Setujui Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Tables\Actions\BulkAction $action, \Illuminate\Database\Eloquent\Collection $records, MembershipService $membershipService) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->status === 'pending') {
                                    $membershipService->approveMembership($record, Auth::id());
                                    $count++;
                                }
                            }
                            
                            Notification::make()
                                ->success()
                                ->title('Persetujuan Massal Berhasil')
                                ->body("$count transaksi berhasil disetujui")
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'membershipPackage', 'approver']);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Cache::remember('pending_transactions_count', 180, function () {
            return Transaction::where('status', 'pending')->count();
        });
        
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }


}
