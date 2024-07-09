@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-8">
                    <h1>User Task Statistics</h1>
                </div>
                <div class="col-md-4 text-right">
                    @can('addTask', \App\Models\User::class)
                        <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary">Create Task</a>
                    @endcan
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Go To Tasks List</a>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Task Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistics as $stat)
                    <tr>
                        <td>{{ $stat->user->name }}</td>
                        <td>{{ $stat->task_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
