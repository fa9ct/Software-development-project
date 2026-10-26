<?php

use App\Models\User;

it('deletes a user', function () {
    $user = User::factory()->create();

    $response = $this->deleteJson("/api/users/{$user->id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'User deleted successfully']);

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

it('returns 404 when deleting a non-existent user', function () {
    $response = $this->deleteJson('/api/users/999');

    $response->assertStatus(404);
});
