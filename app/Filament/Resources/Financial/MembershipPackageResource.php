<?php

namespace App\Filament\Resources\Financial;

use App\Filament\Resources\Financial\MembershipPackageResource\Pages;
use App\Models\MembershipPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MembershipPackageResource extends Resource
{
    protected static ?string $model = MembershipPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Paket Membership';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Paket Membership';

    protected static ?string $pluralModelLabel = 'Paket Membership';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Paket')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Paket')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: 1 Bulan, 3 Bulan, dll'),

                        Forms\Components\Select::make('duration_months')
                            ->label('Durasi (Bulan)')
                            ->options([
                                1 => '1 Bulan',
                                2 => '2 Bulan',
                                3 => '3 Bulan',
                                6 => '6 Bulan',
                                9 => '9 Bulan',
                                12 => '12 Bulan',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Hanya paket aktif yang bisa dipilih member'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Harga & Diskon')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0)
                            ->step(1000)
                            ->placeholder('300000'),

                        Forms\Components\TextInput::make('discount_percentage')
                            ->label('Diskon (%)')
                            ->numeric()
                            ->suffix('%')
                            ->nullable()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01)
                            ->placeholder('10')
                            ->helperText('Opsional - Persentase diskon dari harga normal'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Deskripsi')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Paket')
                            ->nullable()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'bulletList',
                                'orderedList',
                            ])
                            ->placeholder('Jelaskan benefit dan keuntungan paket ini...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Paket')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('duration_months')
                    ->label('Durasi')
                    ->formatStateUsing(fn ($state) => $state . ' Bulan')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount_percentage')
                    ->label('Diskon')
                    ->formatStateUsing(fn ($state) => $state ? $state . '%' : '-')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('discounted_price')
                    ->label('Harga Setelah Diskon')
                    ->money('IDR')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('price', $direction);
                    }),

                Tables\Columns\TextColumn::make('price_per_month')
                    ->label('Harga/Bulan')
                    ->money('IDR')
                    ->color('success')
                    ->description(fn (MembershipPackage $record) => 
                        $record->duration_months > 1 ? 'Lebih hemat!' : null
                    ),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('transactions_count')
                    ->label('Total Transaksi')
                    ->counts('transactions')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('duration_months', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Nonaktif',
                    ])
                    ->default(1),

                Tables\Filters\SelectFilter::make('duration_months')
                    ->label('Durasi')
                    ->options([
                        1 => '1 Bulan',
                        3 => '3 Bulan',
                        6 => '6 Bulan',
                        12 => '12 Bulan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalDescription('Paket yang sudah digunakan dalam transaksi tidak bisa dihapus.'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembershipPackages::route('/'),
            'create' => Pages\CreateMembershipPackage::route('/create'),
            'edit' => Pages\EditMembershipPackage::route('/{record}/edit'),
        ];
    }
}
