<?php

namespace App\Filament\Resources\SupportOrderResource\Pages;

use App\Filament\Resources\SupportOrderResource;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditSupportOrder extends EditRecord
{

    protected $listeners = ['refresh' => 'refreshForm'];
    protected static string $resource = SupportOrderResource::class;

  

    public function mount($record): void
    {
        if (!$this->record) {
            // Ensure that the record is initialized
            $this->record = $record;
        }

        parent::mount($record);

        $this->refreshForm();

    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            ButtonAction::make('pdf')
                ->label('PDF')
                ->url(fn($record) => route('alaa.pdf', $record))
                ->openUrlInNewTab(),
        ];
    }

    public function refreshForm()
    {
        $this->record->Total = 0;
        $this->form->fill($this->record->toArray());
    }

}
