<?php

use App\Filament\Resources\UserResource\Pages\ManageUsers;
use App\Models\User;
use function Pest\Laravel\{actingAs};
use function Pest\Livewire\livewire;
 
it('can list users', function () {
    $user = User::factory()->create(['role'=>'admin']);
 
    actingAs($user)->get('/admin/users')
        ->assertStatus(200);

    $users = User::factory(5)->create();
    livewire(ManageUsers::class)
        ->assertCanSeeTableRecords($users);
});