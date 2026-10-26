<?php

use App\Models\User;

it('creates a user with valid data', function () {
    $payload = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'secret123',
        'phone_number' => '1234567890',
        'role' => 'admin',
    ];

    $response = $this->postJson('/api/users', $payload);

    $response->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '1234567890',
            'role' => 'admin',
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'phone_number' => '1234567890',
        'role' => 'admin',
    ]);
});

it('fails to create a user without required fields', function () {
    $response = $this->postJson('/api/users', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'password']);
});

it('fails to create a user with a duplicate email', function () {
    User::factory()->create(['email' => 'taken@example.com']);

    $response = $this->postJson('/api/users', [
        'name' => 'Jane Doe',
        'email' => 'taken@example.com',
        'password' => 'secret123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});
