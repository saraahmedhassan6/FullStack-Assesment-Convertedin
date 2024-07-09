<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Statistics;
use App\Models\Role;
use Database\Seeders\RoleSeeder;
class StatisticTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_checks_statistics_update()
    {
        // Run the role seeder
        $this->seed(RoleSeeder::class);

        // Create a user with a role
        $user = User::factory()->create(['role_id' => Role::where('name', 'user')->first()->id]);

        // Create a statistic
        $statistic = Statistics::create([
            'user_id' => $user->id,
            'task_count' => 0,
        ]);

        // Update the task count
        $statistic->task_count = 1;
        $statistic->save();

        // Retrieve the updated statistic
        $updatedStatistic = Statistics::find($statistic->id);

        // Assert that the statistics table is updated correctly
        $this->assertEquals(1, $updatedStatistic->task_count);
    }
}
