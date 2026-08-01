<?php

namespace App\Filament\Widgets\Lists;

use App\Models\MemberProgress;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentProgressWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Pelacakan Progres Terbaru';

    protected static bool $isLazy = true;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                MemberProgress::with('user')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Anggota')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('berat_badan')
                    ->label('Berat (kg)')
                    ->suffix(' kg')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('tinggi_badan')
                    ->label('Tinggi (cm)')
                    ->suffix(' cm')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('body_fat')
                    ->label('Lemak Tubuh (%)')
                    ->suffix('%')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('muscle_mass')
                    ->label('Massa Otot (kg)')
                    ->suffix(' kg')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dicatat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
