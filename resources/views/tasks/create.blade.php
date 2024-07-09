@extends('layouts.app')

@section('content')
    @can('addTask', \App\Models\User::class)
        <div class="container">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Create Task</h1>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Go To Tasks List</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="admin">Admin</label>
                    <select name="assigned_by_id" class="form-control">
                        @foreach ($admins as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="assigned_to">Assigned To</label>
                    <select name="assigned_to_id" class="form-control">
                        @foreach ($users as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create Task</button>
            </form>
        </div>
    @endcan
@endsection
