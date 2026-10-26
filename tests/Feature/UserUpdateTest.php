<?php

use App\Models\User;

it('updates a user with valid data', function () {
    $user = User::factory()->create();

    $response = $this->putJson("/api/users/{$user->id}", [
        'name' => 'Updated Name',
        'phone_number' => '9999999999',
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => 'Updated Name',
            'phone_number' => '9999999999',
        ]);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
    ]);
});

it('fails to update a user with an invalid email', function () {
    $user = User::factory()->create();

    $response = $this->putJson("/api/users/{$user->id}", [
        'email' => 'not-an-email',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

it('fails to update a user with a duplicate email', function () {
    $existingUser = User::factory()->create(['email' => 'taken@example.com']);
    $user = User::factory()->create();

    $response = $this->putJson("/api/users/{$user->id}", [
        'email' => 'taken@example.com',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});
