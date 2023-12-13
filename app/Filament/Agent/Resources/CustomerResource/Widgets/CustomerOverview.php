<?php

namespace App\Filament\Agent\Resources\CustomerResource\Widgets;

use App\Filament\Agent\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class CustomerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', $this->getQuery()->count()),
        ];
    }

    private function getQuery()
    {
        return Customer::where('agent_id',Auth::user()->agent?->id)->newQuery();
    }
}
