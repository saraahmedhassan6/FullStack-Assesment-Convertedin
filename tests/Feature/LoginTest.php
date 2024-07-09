<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_login_with_valid_data()
    {
        // Create a role with user
        $role = Role::create(['name' => 'User']); 

        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt($password = 'password'),
            'role_id' => $role->id, 
        ]);

        // login with valid data
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assertions
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_with_invalid_data()
    {
        // Create a role
        $role = Role::create(['name' => 'User']);

        // Create a user 
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id, 
        ]);

        // login with invalid data
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        // Assertions
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
