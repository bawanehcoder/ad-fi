<?php

namespace App\Filament\Resources\OrderInvoicedResource\Pages;

use App\Filament\Resources\OrderInvoicedResource;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderInvoicedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ButtonAction::make('pdf')
                ->label('PDF')
                ->url(fn($record) => route('alaa.pdf', $record))
                ->openUrlInNewTab(),
        ];
    }
}
