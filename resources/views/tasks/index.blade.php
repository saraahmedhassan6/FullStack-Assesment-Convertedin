@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-8">
                    <h1>Tasks List</h1>
                </div>
                <div class="col-md-4 text-right">
                    @can('addTask', \App\Models\User::class)
                        <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary">Create Task</a>
                    @endcan
                    <a href="{{ route('statistics.index') }}" class="btn btn-outline-primary">Go To Statistics List</a>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned User</th>
                    <th>Admin Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->assignedTo->name }}</td>
                        <td>{{ $task->assignedBy->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <nav aria-label="Page navigation example">
                <ul class="pagination" style="display: flex; justify-content: center; padding-left: 0; list-style: none; border-radius: 0.25rem;">
                    {{-- Previous Page Link --}}
                    @if ($tasks->onFirstPage())
                        <li class="page-item disabled" style="margin: 0 5px;" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" style="color: #6c757d; text-decoration: none; padding: 0.5rem 0.75rem; border: 1px solid #dee2e6; border-radius: 0.25rem;" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item" style="margin: 0 5px;">
                            <a class="page-link" href="{{ $tasks->previousPageUrl() }}" rel="prev" style="color: #007bff; text-decoration: none; padding: 0.5rem 0.75rem; border: 1px solid #dee2e6; border-radius: 0.25rem;" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif                    

                    {{-- Next Page Link --}}
                    @if ($tasks->hasMorePages())
                        <li class="page-item" style="margin: 0 5px;">
                            <a class="page-link" href="{{ $tasks->nextPageUrl() }}" rel="next" style="color: #007bff; text-decoration: none; padding: 0.5rem 0.75rem; border: 1px solid #dee2e6; border-radius: 0.25rem;" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" style="margin: 0 5px;" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" style="color: #6c757d; text-decoration: none; padding: 0.5rem 0.75rem; border: 1px solid #dee2e6; border-radius: 0.25rem;" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
