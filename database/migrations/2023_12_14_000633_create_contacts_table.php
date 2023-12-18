<?php

use App\Models\Invoice;
use App\Models\InvoiceAgent;
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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(InvoiceAgent::class)->constrained();
            $table->timestamp('call_time')->nullable();
            $table->string('call_type');
            $table->string('call_result');
            $table->text('detail')->nullable();
            $table->text('notes')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
