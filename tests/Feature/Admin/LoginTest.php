<?php

use App\Models\User;
use function Pest\Laravel\{actingAs};
 
test('admin can access the dashboard', function () {
    $user = User::factory()->create(['role'=>'admin']);
 
    actingAs($user)->get('/admin')
        ->assertStatus(200);
});
 
test('non admin can not access the dashboard', function () {
    $user = User::factory()->create(['role'=>'agent']);
 
    actingAs($user)->get('/admin')
        ->assertStatus(403);
});