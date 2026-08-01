<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankDetailResource\Pages;
use App\Filament\Resources\BankDetailResource\RelationManagers;
use App\Models\BankDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankDetailResource extends Resource
{
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationLabel = 'Rekening Bank';
    protected static ?string $modelLabel = 'Rekening Bank';
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Rekening')
                    ->schema([
                        Forms\Components\TextInput::make('bank_name')
                            ->label('Nama Bank')
                            ->required()
                            ->placeholder('Contoh: BCA'),
                        Forms\Components\TextInput::make('account_number')
                            ->label('Nomor Rekening')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('account_name')
                            ->label('Atas Nama')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Jika nonaktif, rekening ini tidak akan muncul di halaman pembayaran member.'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Bank')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('account_number')
                    ->label('No. Rekening')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_name')
                    ->label('Atas Nama')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankDetails::route('/'),
            'create' => Pages\CreateBankDetail::route('/create'),
            'edit' => Pages\EditBankDetail::route('/{record}/edit'),
        ];
    }
}
