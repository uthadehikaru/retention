<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'billing_account' => fake()->unique()->numerify('#######'),
            'customer_id' => fake()->unique()->numerify('MTX#######'),
            'name' => fake()->name(),
            'hp' => fake()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'outstanding' => '',
            'agent_id' => null,
        ];
    }
}
