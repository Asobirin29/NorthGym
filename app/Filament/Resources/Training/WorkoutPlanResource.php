<?php

namespace App\Filament\Resources\Training;

use App\Filament\Resources\Training\WorkoutPlanResource\Pages;
use App\Models\WorkoutPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkoutPlanResource extends Resource
{
    protected static ?string $model = WorkoutPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    protected static ?string $navigationLabel = 'Program Latihan';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Program')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Program')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4),

                        Forms\Components\Select::make('kategori')
                            ->options([
                                'cardio' => 'Kardio',
                                'strength' => 'Kekuatan',
                                'flexibility' => 'Fleksibilitas',
                                'hiit' => 'HIIT',
                                'endurance' => 'Daya Tahan',
                            ])
                            ->required(),

                        Forms\Components\Select::make('level')
                            ->options([
                                'beginner' => 'Pemula',
                                'intermediate' => 'Menengah',
                                'advanced' => 'Lanjutan',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('media_path')
                            ->label('Upload Video/GIF')
                            ->acceptedFileTypes(['video/mp4', 'image/gif', 'video/webm'])
                            ->maxSize(51200) // 50MB
                            ->directory('workout-media'),

                        Forms\Components\TextInput::make('media_url')
                            ->label('URL Video Eksternal')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('Isi jika menggunakan video dari YouTube atau platform lain'),
                    ]),

                Forms\Components\Section::make('Detail Latihan')
                    ->schema([
                        Forms\Components\TextInput::make('durasi_menit')
                            ->label('Durasi (menit)')
                            ->numeric()
                            ->suffix('menit'),

                        Forms\Components\TextInput::make('kalori_estimasi')
                            ->label('Estimasi Kalori Terbakar')
                            ->numeric()
                            ->suffix('kcal'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cardio' => 'info',
                        'strength' => 'danger',
                        'flexibility' => 'success',
                        'hiit' => 'warning',
                        'endurance' => 'primary',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'beginner' => 'success',
                        'intermediate' => 'warning',
                        'advanced' => 'danger',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('durasi_menit')
                    ->label('Durasi')
                    ->formatStateUsing(fn ($state) => $state ? $state . ' menit' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kalori_estimasi')
                    ->label('Kalori')
                    ->formatStateUsing(fn ($state) => $state ? $state . ' kcal' : '-')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'cardio' => 'Kardio',
                        'strength' => 'Kekuatan',
                        'flexibility' => 'Fleksibilitas',
                        'hiit' => 'HIIT',
                        'endurance' => 'Daya Tahan',
                    ]),

                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'beginner' => 'Pemula',
                        'intermediate' => 'Menengah',
                        'advanced' => 'Lanjutan',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
            'index' => Pages\ListWorkoutPlans::route('/'),
            'create' => Pages\CreateWorkoutPlan::route('/create'),
            'edit' => Pages\EditWorkoutPlan::route('/{record}/edit'),
        ];
    }
}
