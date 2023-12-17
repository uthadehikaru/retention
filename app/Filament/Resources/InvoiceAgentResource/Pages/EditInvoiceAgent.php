<?php

namespace App\Filament\Resources\InvoiceAgentResource\Pages;

use App\Filament\Resources\InvoiceAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceAgent extends EditRecord
{
    protected static string $resource = InvoiceAgentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
