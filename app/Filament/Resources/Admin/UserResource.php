<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Anggota';

    protected static ?string $navigationGroup = 'Keanggotaan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Personal')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Keanggotaan & Peran')
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'member' => 'Member',
                            ])
                            ->default('member')
                            ->required(),

                        Forms\Components\DatePicker::make('membership_start_date')
                            ->label('Tanggal Mulai Membership')
                            ->default(now()),

                        Forms\Components\DatePicker::make('membership_end_date')
                            ->label('Tanggal Berakhir Membership')
                            ->afterOrEqual('membership_start_date'),

                        Forms\Components\Toggle::make('status_aktif')
                            ->label('Status Aktif')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'primary',
                        'member' => 'success',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('membership_end_date')
                    ->label('Kedaluwarsa')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn (User $record): string => $record->isMembershipExpired() ? 'danger' : 'success'),

                Tables\Columns\IconColumn::make('status_aktif')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'member' => 'Member',
                    ]),

                Tables\Filters\TernaryFilter::make('status_aktif')
                    ->label('Status Membership')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),

                Tables\Filters\Filter::make('expired')
                    ->label('Keanggotaan Kedaluwarsa')
                    ->query(fn (Builder $query): Builder => $query->expiredMembers()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'member')
            ->with(['transactions', 'memberProgress']);
    }
}
