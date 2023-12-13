<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class InvoiceAgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id'=>0,
            'agent_id'=>0,
            'start_date' => fake()->dateTimeThisYear(),
            'end_date' => fake()->dateTimeThisYear(),
        ];
    }
}
