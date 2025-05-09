<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'User Management';

    // Pastikan Shield policy mengontrol semua akses ke resource ini
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(15)
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                        Select::make('role')
                            ->options(fn () => Role::pluck('name', 'name')->toArray())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state === 'teacher') {
                                    $set('teacher.nip', 'T-' . rand(10000, 99999));
                                    $set('teacher.subject', 'General');
                                    $set('teacher.address', 'Alamat belum diisi');
                                }
                            }),
                    ])->columns(2),
                Forms\Components\Section::make('Teacher Details')
                    ->schema([
                        Forms\Components\TextInput::make('teacher.nip')
                            ->label('NIP (Employee ID)')
                            ->maxLength(20)
                            ->default('T-' . rand(10000, 99999))
                            ->required(false),
                        Forms\Components\TextInput::make('teacher.subject')
                            ->label('Subject')
                            ->maxLength(50)
                            ->default('General')
                            ->required(false),
                        Forms\Components\Textarea::make('teacher.address')
                            ->label('Address')
                            ->maxLength(255)
                            ->default('Alamat belum diisi')
                            ->required(false),
                    ])
                    ->columns(2)
                    ->visible(fn (callable $get) => $get('role') === 'teacher'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'teacher' => 'success',
                        'parent' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'teacher' => 'Teacher',
                        'parent' => 'Parent',
                    ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
