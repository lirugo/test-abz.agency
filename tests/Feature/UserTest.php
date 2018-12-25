<?php

namespace Tests\Feature;

use App\Models\User\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    public function testUserIndex()
    {
        $this->json('GET', '/api/users')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'email', 'created_at', 'updated_at'],
            ]);
    }

    public function testUserStore()
    {
        $email = $this->faker->unique()->safeEmail;
        $payload = [
            'email' => $email,
            'password' => bcrypt('password')
        ];

        $this->json('POST', '/api/users', $payload)
            ->assertStatus(201)
            ->assertJson(['email' => $email]);

        User::where('email', $email)->delete();
    }

    public function testUserUpdate(){
        $user = factory(User::class)->create([
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);

        $newEmail = $this->faker->unique()->safeEmail;
        $payload = [
            'email' => $newEmail,
        ];

        $this->json('PUT', '/api/users/' . $user->id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'email' => $newEmail,
            ]);

        $user->delete();
    }

    public function testUserDelete()
    {
        $user = factory(User::class)->create([
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);
        $this->json('DELETE', '/api/users/' . $user->id)
            ->assertStatus(204);
    }
}
