<?php

namespace App\Filament\Widgets\Lists;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMembersWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Anggota Terbaru';

    protected static bool $isLazy = true;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::where('role', 'member')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),
                
                Tables\Columns\BadgeColumn::make('status_aktif')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif')
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ]),
                
                Tables\Columns\TextColumn::make('membership_end_date')
                    ->label('Berakhir')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
