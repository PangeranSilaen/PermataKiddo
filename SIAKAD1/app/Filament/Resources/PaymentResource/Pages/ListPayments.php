<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    public function getTitle(): string
    {
        return 'Daftar Pembayaran SPP';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Pembayaran Baru'),
        ];
    }
    
    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         PaymentResource\Widgets\PaymentChart::class,
    //     ];
    // }
}
