<?php

namespace App\Filament\Resources\InvoiceResource\Widgets;

use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InvoiceStat extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Unpaid Invoices', Invoice::select('id')->unpaid()->count())
            ->color('primary'),
            Stat::make('Paid Invoices', Invoice::select('id')->paid()->count())
            ->color('primary'),
            Stat::make('Suspended Invoices', Invoice::select('id')->suspended()->count())
            ->color('primary'),
            Stat::make('Terminated Invoices', Invoice::select('id')->terminated()->count())
            ->color('primary'),
        ];
    }
}
