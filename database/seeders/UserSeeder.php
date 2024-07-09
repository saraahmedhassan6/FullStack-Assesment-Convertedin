<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the role user and admin rows from the database
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // Call Factory to create 100 admin and 10000 user 
        User::factory(100)->create(['role_id' => $adminRole->id]);
        User::factory(10000)->create(['role_id' => $userRole->id]);
    }
}
