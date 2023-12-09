<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->has(Agent::factory()
            ->has(Customer::factory(10))
            ->state(function(array $attributes, User $user){
            return [
                'name' => $user->name,
            ];
        }))->create(['role'=>'agent','name'=>'Agent','email'=>'agent@laravel.test']);

        User::factory(10)->has(Agent::factory()
            ->has(Customer::factory(5))
            ->state(function(array $attributes, User $user){
            return [
                'name' => $user->name,
            ];
        }))->create(['role'=>'agent']);
    }
}
