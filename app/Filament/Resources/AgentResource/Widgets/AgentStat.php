<?php

namespace App\Filament\Resources\AgentResource\Widgets;

use App\Models\Agent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AgentStat extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    protected function getStats(): array
    {
        return [
            Stat::make('All Agents', Agent::select('id')->count())
            ->color('primary'),
            Stat::make('Active Agents', Agent::select('id')->active()->count())
            ->color('success'),
            Stat::make('Inactive Agents', Agent::select('id')->inactive()->count())
            ->color('warning'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }
}
