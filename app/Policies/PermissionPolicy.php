<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // addTask permission to only admin can use to create task
    public function addTask(User $user)
    {
        return $user->role->name === 'admin';
    }
}
