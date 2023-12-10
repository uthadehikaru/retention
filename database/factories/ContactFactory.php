<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => 0,
            'call_time' => fake()->dateTimeThisMonth(),
            'call_type' => fake()->randomElement(Contact::CALL_TYPE),
            'call_result' => fake()->randomElement(Contact::CALL_RESULT),
            'detail' => fake()->sentence(),
            'notes' => fake()->sentence(),
        ];
    }
}
