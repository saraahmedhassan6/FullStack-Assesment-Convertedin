<?php

namespace Tests\Unit;
use App\Models\Role;

use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function test_creates_a_role_admin()
    {
        // Create a role with admin
        $role = new Role(['name' => 'admin']);
        // Assert that the same role
        $this->assertEquals('admin', $role->name);
    }

    public function test_creates_a_role_user()
    {
        // Create a role with user
        $role = new Role(['name' => 'user']);
        // Assert that the same role
        $this->assertEquals('user', $role->name);
    }
}
