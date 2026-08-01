<?php

namespace App\Filament\Resources\Membership;

use App\Filament\Resources\Membership\MemberProgressResource\Pages;
use App\Models\MemberProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MemberProgressResource extends Resource
{
    protected static ?string $model = MemberProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Progres Anggota';

    protected static ?string $navigationGroup = 'Keanggotaan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Member')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Member')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabled(fn ($record) => $record !== null),

                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Pencatatan')
                            ->required()
                            ->default(now()),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Ukuran Tubuh')
                    ->schema([
                        Forms\Components\TextInput::make('berat_badan')
                            ->label('Berat Badan')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('kg'),

                        Forms\Components\TextInput::make('tinggi_badan')
                            ->label('Tinggi Badan')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm'),

                        Forms\Components\TextInput::make('lingkar_perut')
                            ->label('Lingkar Perut')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm'),

                        Forms\Components\TextInput::make('lingkar_dada')
                            ->label('Lingkar Dada')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm'),

                        Forms\Components\TextInput::make('lingkar_lengan')
                            ->label('Lingkar Lengan')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Foto Progress')
                    ->description('Untuk privasi member, foto tidak dapat dilihat di dashboard admin.')
                    ->schema([
                        Forms\Components\Placeholder::make('foto_privacy_note')
                            ->label('Catatan Privasi')
                            ->content('Foto progress member bersifat pribadi dan tidak ditampilkan untuk menjaga privasi.')
                            ->columnSpanFull(),
                        
                        // FileUpload masih ada untuk admin bisa upload foto baru jika diperlukan
                        // Tapi tidak menampilkan preview foto yang sudah ada
                        Forms\Components\FileUpload::make('foto_before_path')
                            ->label('Upload Foto Before (Opsional)')
                            ->image()
                            ->maxSize(5120)
                            ->directory('progress-photos')
                            ->imagePreviewHeight('100')
                            ->panelLayout('compact')
                            ->visibility('private')
                            ->hidden(fn ($record) => $record !== null), // Hidden saat edit

                        Forms\Components\FileUpload::make('foto_after_path')
                            ->label('Upload Foto After (Opsional)')
                            ->image()
                            ->maxSize(5120)
                            ->directory('progress-photos')
                            ->imagePreviewHeight('100')
                            ->panelLayout('compact')
                            ->visibility('private')
                            ->hidden(fn ($record) => $record !== null), // Hidden saat edit
                    ])
                    ->columns(2)
                    ->collapsed(),

                Forms\Components\Section::make('Catatan')
                    ->schema([
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Data Member')
                    ->schema([
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Nama Member'),
                        
                        Infolists\Components\TextEntry::make('tanggal')
                            ->label('Tanggal Pencatatan')
                            ->date('d M Y'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Ukuran Tubuh')
                    ->schema([
                        Infolists\Components\TextEntry::make('berat_badan')
                            ->label('Berat Badan')
                            ->suffix(' kg'),

                        Infolists\Components\TextEntry::make('tinggi_badan')
                            ->label('Tinggi Badan')
                            ->suffix(' cm'),

                        Infolists\Components\TextEntry::make('lingkar_perut')
                            ->label('Lingkar Perut')
                            ->suffix(' cm'),

                        Infolists\Components\TextEntry::make('lingkar_dada')
                            ->label('Lingkar Dada')
                            ->suffix(' cm'),

                        Infolists\Components\TextEntry::make('lingkar_lengan')
                            ->label('Lingkar Lengan')
                            ->suffix(' cm'),
                        
                        Infolists\Components\TextEntry::make('body_fat')
                            ->label('Lemak Tubuh')
                            ->suffix('%'),

                        Infolists\Components\TextEntry::make('muscle_mass')
                            ->label('Massa Otot')
                            ->suffix(' kg'),
                    ])
                    ->columns(3),

                Infolists\Components\Section::make('Foto Progress')
                    ->description('Untuk privasi member, foto tidak ditampilkan di dashboard admin.')
                    ->schema([
                        Infolists\Components\TextEntry::make('foto_privacy')
                            ->label('Status Foto')
                            ->default('Foto progress member bersifat pribadi dan dilindungi')
                            ->color('warning')
                            ->icon('heroicon-o-lock-closed'),
                    ])
                    ->collapsed(),

                Infolists\Components\Section::make('Catatan')
                    ->schema([
                        Infolists\Components\TextEntry::make('catatan')
                            ->label('Catatan')
                            ->default('-'),
                    ]),
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

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('berat_badan')
                    ->label('Berat')
                    ->formatStateUsing(fn ($state) => $state ? $state . ' kg' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('bmi')
                    ->label('BMI')
                    ->getStateUsing(fn ($record) => $record->bmi ?? '-'),

                Tables\Columns\TextColumn::make('bmi_category')
                    ->label('Kategori BMI')
                    ->getStateUsing(fn ($record) => $record->bmi_category ?? '-')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'Kurus' => 'warning',
                        'Normal' => 'success',
                        'Berat Berlebih' => 'warning',
                        'Obesitas' => 'danger',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('lingkar_perut')
                    ->label('Lingkar Perut')
                    ->formatStateUsing(fn ($state) => $state ? $state . ' cm' : '-')
                    ->toggleable(),

                // Foto progress disembunyikan untuk privasi member
                // Tables\Columns\ImageColumn::make('foto_before_path')
                //     ->label('Before')
                //     ->circular()
                //     ->toggleable(isToggledHiddenByDefault: true),

                // Tables\Columns\ImageColumn::make('foto_after_path')
                //     ->label('After')
                //     ->circular()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Member')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMemberProgress::route('/'),
            'create' => Pages\CreateMemberProgress::route('/create'),
            'edit' => Pages\EditMemberProgress::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('user');
    }
}
