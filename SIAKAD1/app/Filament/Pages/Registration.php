<?php

namespace App\Filament\Pages;

use App\Models\Registration as RegistrationModel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Registration extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Daftar Siswa Baru';
    protected static ?string $title = 'Pendaftaran Siswa Baru';
    protected static bool $shouldRegisterNavigation = true;
    protected static string $view = 'filament.pages.registration';
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Siswa')
                    ->description('Silakan isi data lengkap calon siswa')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->required(),
                        Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('student-photos')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Informasi Orang Tua')
                    ->description('Isi informasi kontak orang tua/wali')
                    ->schema([
                        TextInput::make('parent_name')
                            ->label('Nama Orang Tua/Wali')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('parent_phone')
                            ->label('Nomor Telepon Orang Tua')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        TextInput::make('parent_email')
                            ->label('Email Orang Tua')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        $data['registration_date'] = now();
        $data['status'] = 'pending';
        RegistrationModel::create($data);
        $this->form->fill();
        Notification::make()
            ->title('Pendaftaran Berhasil')
            ->body('Pendaftaran Anda telah berhasil dikirim. Kami akan segera memproses pendaftaran Anda.')
            ->success()
            ->send();
    }
}
