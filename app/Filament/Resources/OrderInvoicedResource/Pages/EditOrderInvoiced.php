<?php

namespace App\Filament\Resources\OrderInvoicedResource\Pages;

use App\Filament\Resources\OrderInvoicedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderInvoiced extends EditRecord
{
    protected static string $resource = OrderInvoicedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
