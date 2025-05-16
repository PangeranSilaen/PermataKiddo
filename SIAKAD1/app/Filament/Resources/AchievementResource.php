<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Academic Management';
    
    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'subject';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Achievement Details')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('teacher_id')
                            ->relationship('teacher', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('subject')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('achievements')
                            ->label('Capaian')
                            ->multiple()
                            ->options([
                                'capaian_1' => 'Capaian 1',
                                'capaian_2' => 'Capaian 2',
                                'capaian_3' => 'Capaian 3',
                                'capaian_4' => 'Capaian 4',
                                'capaian_5' => 'Capaian 5',
                                'capaian_6' => 'Capaian 6',
                                'capaian_7' => 'Capaian 7',
                                'capaian_8' => 'Capaian 8',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Score Information')
                    ->schema([
                        Forms\Components\DatePicker::make('achievement_date')
                            ->required(),
                        Forms\Components\Select::make('semester')
                            ->options([
                                '1' => 'Semester 1',
                                '2' => 'Semester 2',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('academic_year')
                            ->required()
                            ->placeholder('2024/2025'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('achievements_count')
                    ->label('Jumlah Capaian')
                    ->formatStateUsing(fn($state) => $state . ' Capaian'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
            'view' => Pages\ViewAchievement::route('/{record}'),
        ];
    }

    // public function getAchievementsCountAttribute()
    // {
    //     $ach = $this->achievements;
    //     if (is_array($ach)) {
    //         return count($ach);
    //     }
    //     if (is_string($ach) && !empty($ach)) {
    //         $arr = json_decode($ach, true);
    //         return is_array($arr) ? count($arr) : 0;
    //     }
    //     return 0;
    // }
}
