<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Jobs\UpdateStatistics;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    // list of tasks with paginate 10 task per view
    public function index()
    {
        $tasks = Task::paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    // create page form
    // apply polices to only admin can reach this page
    // get admins and users and pass it to form to enable dropdown in form
    public function create()
    {
        $this->authorize('addTask', User::class);
        $admins = User::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->pluck('name', 'id');

        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'user');
        })->pluck('name', 'id');

        return view('tasks.create', compact('admins', 'users'));
    }

    // apply polices to only admin can store tasks
    // validate the inputs before saving
    // store data and update statistics in background (job)
    // redirect to tasks list
    public function store(TaskRequest $request)
    {
        $this->authorize('addTask', User::class);
        Task::create($request->all());
        UpdateStatistics::dispatch();
    
        return redirect()->route('tasks.index');
    }
}
