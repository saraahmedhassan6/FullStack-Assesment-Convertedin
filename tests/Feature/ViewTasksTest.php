<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\Role;

class ViewTasksTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_view_tasks()
    {
        // Create a role
        $role = Role::create(['name' => 'User']); // Ensure a role exists

        // Create a user with the role_id
        $user = User::factory()->create([
            'role_id' => $role->id, // Assign the created role
        ]);

        // Create some tasks manually
        for ($i = 1; $i <= 10; $i++) {
            Task::create([
                'title' => "Task $i",
                'description' => "Description for task $i",
                'assigned_to_id' => $user->id,
                'assigned_by_id' => $user->id,
            ]);
        }

        // Visit the tasks page
        $response = $this->actingAs($user)->get('/tasks');

        // Assert the response status
        $response->assertStatus(200);

        // Assert that tasks are visible
        $response->assertSee('Task 1');
        $response->assertSee('Description for task 1');
        $response->assertSee($user->name); // Assuming user name is displayed for assigned_to and assigned_by
    }
}
