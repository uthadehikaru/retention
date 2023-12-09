<?php

use App\Models\Agent;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('billing_account');
            $table->string('customer_id');
            $table->string('name');
            $table->string('hp');
            $table->string('email');
            $table->string('outstanding')->nullable();
            $table->foreignIdFor(Agent::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
