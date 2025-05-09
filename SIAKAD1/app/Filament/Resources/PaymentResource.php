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

    protected static ?string $navigationGroup = 'Finance Management';

    protected static ?string $recordTitleAttribute = 'receipt_number';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('payment_type')
                            ->options([
                                'spp' => 'SPP',
                                'other' => 'Lainnya',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Preview receipt number format
                                $prefix = $state === 'spp' ? 'SPP-' : 'LYN-';
                                $set('receipt_preview', $prefix . 'X0000 (akan digenerate otomatis)');
                            }),
                        Forms\Components\TextInput::make('receipt_preview')
                            ->label('Format Kode Pembayaran')
                            ->helperText('Kode pembayaran akan digenerate otomatis saat disimpan')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('amount')
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

                Forms\Components\Section::make('Payment Details')
                    ->schema([
                        Forms\Components\DatePicker::make('payment_date')
                            ->required()
                            ->default(now()),
                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'credit_card' => 'Credit Card',
                                'bank_transfer' => 'Bank Transfer',
                                'e_wallet' => 'E-Wallet',
                                'other' => 'Other',
                            ]),
                        Forms\Components\Select::make('month')
                            ->options([
                                'january' => 'January',
                                'february' => 'February',
                                'march' => 'March',
                                'april' => 'April',
                                'may' => 'May',
                                'june' => 'June',
                                'july' => 'July',
                                'august' => 'August',
                                'september' => 'September',
                                'october' => 'October',
                                'november' => 'November',
                                'december' => 'December',
                            ]),
                        Forms\Components\TextInput::make('academic_year')
                            ->required()
                            ->placeholder('2024/2025'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'paid' => 'Paid',
                                'pending' => 'Pending',
                                'cancelled' => 'Cancelled',
                                'refunded' => 'Refunded',
                            ])
                            ->default('paid')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Textarea::make('notes')
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->circular(),
                Tables\Columns\TextColumn::make('academic_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        'refunded' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_type')
                    ->options([
                        'spp' => 'SPP',
                        'other' => 'Lainnya',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ]),
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
