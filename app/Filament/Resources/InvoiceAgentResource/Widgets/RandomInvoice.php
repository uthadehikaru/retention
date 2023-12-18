<?php

namespace App\Filament\Resources\InvoiceAgentResource\Widgets;

use App\Models\Agent;
use App\Models\Invoice;
use App\Models\InvoiceAgent;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class RandomInvoice extends Widget
{
    protected static string $view = 'filament.resources.invoice-agent-resource.widgets.random-invoice';

    protected int | string | array $columnSpan = 'full';
    
    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }

    public $currentDate;
    public $agents = 0;
    public $invoices = 0;

    public function mount()
    {
        $this->currentDate = Carbon::now()->format('d M Y');
        $this->agents = InvoiceAgent::select('agent_id')
        ->whereDate('start_date','<=',Carbon::now())
        ->whereDate('end_date','>=',Carbon::now())
        ->groupBy('agent_id')
        ->get()->count();
        $this->invoices = InvoiceAgent::select('invoice_id')
        ->whereDate('start_date','<=',Carbon::now())
        ->whereDate('end_date','>=',Carbon::now())
        ->groupBy('invoice_id')
        ->get()->count();
    }

    public function randomize()
    {
        $agents = Agent::active()->pluck('id');
        $invoices = Invoice::unpaid()->pluck('id');

        $invoicePerAgent = ceil(count($invoices)/count($agents));
        $start_date = CarbonImmutable::now()->startOfDay();
        $end_date = CarbonImmutable::now()->addDays(3)->endOfDay();
        $i = 0;
        $count = 0;
        foreach($invoices as $invoice){
            if($count==$invoicePerAgent){
                $i++;
                $count = 0;
            }
            InvoiceAgent::create([
                'invoice_id'=>$invoice,
                'agent_id'=>$agents[$i],
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);

            $count++;
        }
        Notification::make()
            ->title('Success')
            ->success()
            ->send();
    }
}
