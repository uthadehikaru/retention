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

        $invoices = InvoiceAgent::own()->count();
        $contacted = InvoiceAgent::own()->today()->whereHas('contacts')->count();
        $uncontacted = InvoiceAgent::own()->today()->whereDoesntHave('contacts')->count();
        return [
            Stat::make('Total Invoices', $invoices),
            Stat::make('Contacted Invoices', $contacted),
            Stat::make('Uncontacted Invoices', $uncontacted),
        ];
    }
}
