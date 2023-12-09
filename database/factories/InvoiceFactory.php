<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => 0,
            'invoice_no' => fake()->numerify('INV-#######'),
            'invoice_date' => fake()->dateTimeThisYear(),
            'total_amount' => fake()->numberBetween(111111,9999999),
            'suspend_date' => null,
            'terminate_date' => null,
        ];
    }
}
