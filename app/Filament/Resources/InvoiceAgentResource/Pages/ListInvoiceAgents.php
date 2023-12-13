<?php

namespace App\Filament\Resources\InvoiceAgentResource\Pages;

use App\Filament\Resources\InvoiceAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceAgents extends ListRecords
{
    protected static string $resource = InvoiceAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
