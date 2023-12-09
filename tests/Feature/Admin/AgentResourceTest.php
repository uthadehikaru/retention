<?php

use App\Filament\Resources\AgentResource;
use App\Filament\Resources\AgentResource\Pages\ListAgents;
use App\Models\User;
use App\Models\Agent;
use function Pest\Laravel\{actingAs};
use function Pest\Livewire\livewire;
 
it('can list agents', function () {
    $user = User::factory()->create(['role'=>'admin']);
 
    actingAs($user)->get('/admin/agents')
        ->assertStatus(200);

    $agents = Agent::factory(5)->for(User::factory())->create();
    livewire(ListAgents::class)
        ->assertCanSeeTableRecords($agents);
});

it('can render create page', function () {
    $user = User::factory()->create(['role'=>'admin']);
    $this->actingAs($user)->get(AgentResource::getUrl('create'))->assertSuccessful();
});