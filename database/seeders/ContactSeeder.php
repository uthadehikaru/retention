<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Invoice::all() as $invoice){
            Contact::factory(2)->for($invoice)->create();
        }
    }
}
