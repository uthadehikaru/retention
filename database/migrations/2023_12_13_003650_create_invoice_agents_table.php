<?php

use App\Models\Agent;
use App\Models\Invoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_agents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Invoice::class)->constrained();
            $table->foreignIdFor(Agent::class)->constrained();
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_agents');
    }
};
