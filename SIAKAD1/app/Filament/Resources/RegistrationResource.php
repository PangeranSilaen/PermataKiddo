<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Resources\RegistrationResource\RelationManagers;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationLabel = 'Pendaftaran Online';
    
    protected static ?string $navigationGroup = 'Manajemen Akademik';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->required(),
                        
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->required(),
                            
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('student-photos')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Informasi Orang Tua')
                    ->schema([
                        Forms\Components\TextInput::make('parent_name')
                            ->label('Nama Orang Tua/Wali')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('parent_phone')
                            ->label('Nomor Telepon Orang Tua')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                            
                        Forms\Components\TextInput::make('parent_email')
                            ->label('Email Orang Tua')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu Persetujuan',
                                'approved' => 'Diterima',
                                'rejected' => 'Ditolak',
                            ])
                            ->default('pending')
                            ->required()
                            ->visible(fn ($livewire) => $livewire instanceof Pages\EditRegistration),
                            
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->visible(fn ($get) => $get('status') === 'rejected')
                            ->requiredIf('status', 'rejected'),
                            
                        Forms\Components\DatePicker::make('registration_date')
                            ->label('Tanggal Pendaftaran')
                            ->default(now())
                            ->required()
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->visible(fn ($livewire) => $livewire instanceof Pages\EditRegistration)
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
                    
                Tables\Columns\TextColumn::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('parent_phone')
                    ->label('Telepon Orang Tua')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('registration_date')
                    ->label('Tanggal Pendaftaran')
                    ->date('d M Y')
                    ->sortable(),
                    
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),
                    
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu Persetujuan',
                        'approved' => 'Diterima',
                        'rejected' => 'Ditolak',
                    ])
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu Persetujuan',
                        'approved' => 'Diterima',
                        'rejected' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Terima')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Registration $record) => $record->status === 'pending')
                    ->action(function (Registration $record) {
                        $record->status = 'approved';
                        $record->save();
                        
                        // Buat entri student baru
                        \App\Models\Student::create([
                            'user_id' => $record->user_id,
                            'name' => $record->name,
                            'registration_number' => 'STD' . date('Y') . str_pad($record->id, 4, '0', STR_PAD_LEFT),
                            'birth_date' => $record->birth_date,
                            'gender' => $record->gender,
                            'address' => $record->address,
                            'parent_name' => $record->parent_name,
                            'parent_phone' => $record->parent_phone,
                            'photo' => $record->photo,
                            'status' => 'active',
                            'join_date' => now(),
                        ]);
                        
                        // Flash notification
                        Notification::make()
                            ->title('Pendaftaran Diterima')
                            ->success()
                            ->send();
                    }),
                    
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Registration $record) => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (Registration $record, array $data) {
                        $record->status = 'rejected';
                        $record->rejection_reason = $data['rejection_reason'];
                        $record->save();
                        
                        // Flash notification
                        Notification::make()
                            ->title('Pendaftaran Ditolak')
                            ->danger()
                            ->send();
                    }),
                    
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approveBulk')
                        ->label('Terima yang Dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            foreach ($records as $record) {
                                if ($record->status !== 'pending') continue;
                                
                                $record->status = 'approved';
                                $record->save();
                                
                                // Buat entri student baru
                                \App\Models\Student::create([
                                    'user_id' => $record->user_id,
                                    'name' => $record->name,
                                    'registration_number' => 'STD' . date('Y') . str_pad($record->id, 4, '0', STR_PAD_LEFT),
                                    'birth_date' => $record->birth_date,
                                    'gender' => $record->gender,
                                    'address' => $record->address,
                                    'parent_name' => $record->parent_name,
                                    'parent_phone' => $record->parent_phone,
                                    'photo' => $record->photo,
                                    'status' => 'active',
                                    'join_date' => now(),
                                ]);
                            }
                            
                            // Flash notification
                            Notification::make()
                                ->title('Pendaftaran Terpilih Diterima')
                                ->success()
                                ->send();
                        }),
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
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }
}
