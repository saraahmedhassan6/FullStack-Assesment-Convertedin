<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Statistics;

class UpdateStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Update the statistics for all users with the role 'user'
        // and calculate the number of tasks assigned to each user
        // and update the corresponding statistics record in the 'statistics' table
        $users = User::whereHas('role', function($query) {
            $query->where('name', 'user');
        })->get();

        foreach ($users as $user) {
            $taskCount = $user->assignedTasks()->count();
            Statistics::updateOrCreate(
                ['user_id' => $user->id],
                ['task_count' => $taskCount]
            );
        }
    }
}
