<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_checks_user_has_a_role()
    {
        // Create a role with admin
        $role = Role::create(['name' => 'admin']);

        // Create a user with the role
        $user = User::factory()->create(['role_id' => $role->id]);

        // Assert that the user has the correct role
        $this->assertEquals('admin', $user->role->name);
    }
}
