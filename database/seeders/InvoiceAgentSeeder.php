<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\InvoiceAgent;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class InvoiceAgentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $agents = Agent::all()->pluck('id');
        $invoices = Invoice::all()->pluck('id');

        $invoicePerAgent = ceil(count($invoices)/count($agents));
        $start_date = CarbonImmutable::now()->subMonth();
        $end_date = CarbonImmutable::now()->addMonth();
        $i = 0;
        $count = 0;
        foreach($invoices as $invoice){
            if($count==$invoicePerAgent){
                $i++;
                $count = 0;
            }
            InvoiceAgent::factory()->has(Contact::factory(2))->create([
                'invoice_id'=>$invoice,
                'agent_id'=>$agents[$i],
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);

            $count++;
        }
    }
}
