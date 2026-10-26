<?php

use App\Models\User;

it('lists all users', function () {
    User::factory()->count(3)->create();

    $response = $this->getJson('/api/users');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('shows a single user', function () {
    $user = User::factory()->create(['name' => 'Jane Doe']);

    $response = $this->getJson("/api/users/{$user->id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'Jane Doe']);
});

it('returns 404 for a non-existent user', function () {
    $response = $this->getJson('/api/users/999');

    $response->assertStatus(404);
});
