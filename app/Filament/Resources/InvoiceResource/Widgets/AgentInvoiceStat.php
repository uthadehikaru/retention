<?php

namespace App\Filament\Resources\InvoiceResource\Widgets;

use App\Models\InvoiceAgent;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class AgentInvoiceStat extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    public static function canView(): bool
    {
        return auth()->user()->agent!=null;
    }

    protected function getStats(): array
    {

        $invoices = InvoiceAgent::assigned()->whereDoesntHave('contacts')->count();
        $contacted = InvoiceAgent::assigned()->today()->whereHas('contacts', fn($query)=> $query->contacted())->count();
        $uncontacted = InvoiceAgent::assigned()->today()->whereHas('contacts', fn($query)=> $query->uncontacted())->count();
        $payPromise = InvoiceAgent::assigned()->today()->whereHas('contacts', fn($query)=> $query->payPromise())->count();
        return [
            Stat::make('Lead Invoices', $invoices),
            Stat::make('Contacted Invoices', $contacted),
            Stat::make('Uncontacted Invoices', $uncontacted),
            Stat::make('Pay Promise', $payPromise),
        ];
    }
}
