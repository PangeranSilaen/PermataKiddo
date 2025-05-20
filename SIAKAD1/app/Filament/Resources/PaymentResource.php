<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Manajemen Keuangan';

    protected static ?string $navigationLabel = 'Pembayaran SPP';

    protected static ?string $recordTitleAttribute = 'receipt_number';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->label('Murid')
                            ->placeholder('Pilih murid')
                            ->relationship('student', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('payment_type')
                            ->label('Jenis Pembayaran')
                            ->options([
                                'spp' => 'SPP',
                                'other' => 'Lainnya',
                            ])
                            ->placeholder('Pilih jenis pembayaran')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $prefix = $state === 'spp' ? 'SPP-' : 'LYN-';
                                $set('receipt_preview', $prefix . 'X0000 (akan digenerate otomatis)');
                            }),
                        Forms\Components\TextInput::make('receipt_preview')
                            ->label('Format Kode Pembayaran')
                            ->helperText('Kode pembayaran akan digenerate otomatis saat disimpan')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('amount')
                            ->label('Nominal')
                            ->placeholder('Masukkan nominal pembayaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Bukti Pembayaran')
                            ->image()
                            ->directory('payment-proofs')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Pembayaran')
                    ->schema([
                        Forms\Components\DatePicker::make('payment_date')
                            ->label('Tanggal Pembayaran')
                            ->required()
                            ->default(now()),
                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'cash' => 'Tunai',
                                'credit_card' => 'Kartu Kredit',
                                'bank_transfer' => 'Transfer Bank',
                                'e_wallet' => 'E-Wallet',
                                'other' => 'Lainnya',
                            ])
                            ->placeholder('Pilih metode pembayaran'),
                        Forms\Components\Select::make('month')
                            ->label('Bulan')
                            ->options([
                                'january' => 'Januari',
                                'february' => 'Februari',
                                'march' => 'Maret',
                                'april' => 'April',
                                'may' => 'Mei',
                                'june' => 'Juni',
                                'july' => 'Juli',
                                'august' => 'Agustus',
                                'september' => 'September',
                                'october' => 'Oktober',
                                'november' => 'November',
                                'december' => 'Desember',
                            ])
                            ->placeholder('Pilih bulan'),
                        Forms\Components\TextInput::make('academic_year')
                            ->label('Tahun Ajaran')
                            ->placeholder('Contoh: 2024/2025')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'paid' => 'Lunas',
                                'pending' => 'Menunggu',
                                'cancelled' => 'Dibatalkan',
                                'refunded' => 'Dikembalikan',
                            ])
                            ->default('paid')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->placeholder('Catatan tambahan (opsional)')
                    ->columnSpanFull()
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('receipt_number')
                    ->label('Kode Pembayaran')
                    ->searchable()
                    ->copyable()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama Murid')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->label('Jenis Pembayaran')
                    ->badge(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'paid' => 'Lunas',
                        'failed' => 'Gagal',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Nominal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Tanggal Pembayaran')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Pembayaran'),
                Tables\Columns\TextColumn::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->circular(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_type')
                    ->label('Jenis Pembayaran')
                    ->options([
                        'spp' => 'SPP',
                        'other' => 'Lainnya',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'paid' => 'Lunas',
                        'pending' => 'Menunggu',
                        'cancelled' => 'Dibatalkan',
                        'refunded' => 'Dikembalikan',
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

    public static function getWidgets(): array
    {
        return [
            PaymentResource\Widgets\PaymentChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
            'view' => Pages\ViewPayment::route('/{record}'),
        ];
    }
}
