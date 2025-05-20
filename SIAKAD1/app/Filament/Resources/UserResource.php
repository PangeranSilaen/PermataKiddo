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
    
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $navigationLabel = 'Pengguna';

    // Pastikan Shield policy mengontrol semua akses ke resource ini
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->placeholder('Masukkan nama lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Masukkan email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->placeholder('Pilih jenis kelamin')
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->placeholder('Masukkan nomor telepon')
                            ->tel()
                            ->maxLength(15)
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->label('Kata Sandi')
                            ->placeholder('Masukkan kata sandi')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                        Select::make('role')
                            ->label('Peran')
                            ->options(fn () => Role::pluck('name', 'name')->toArray())
                            ->placeholder('Pilih peran')
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
                Forms\Components\Section::make('Detail Guru')
                    ->schema([
                        Forms\Components\TextInput::make('teacher.nip')
                            ->label('NIP')
                            ->placeholder('Masukkan NIP')
                            ->maxLength(20)
                            ->default('T-' . rand(10000, 99999))
                            ->required(false),
                        Forms\Components\TextInput::make('teacher.subject')
                            ->label('Mata Pelajaran')
                            ->placeholder('Masukkan mata pelajaran')
                            ->maxLength(50)
                            ->default('General')
                            ->required(false),
                        Forms\Components\Textarea::make('teacher.address')
                            ->label('Alamat')
                            ->placeholder('Masukkan alamat')
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
