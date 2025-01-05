<?php

namespace App\Filament\Resources\SupportOrderResource\Pages;

use App\Filament\Resources\SupportOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSupportOrders extends ListRecords
{
    protected static string $resource = SupportOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Order'),
        ];
    }
}
