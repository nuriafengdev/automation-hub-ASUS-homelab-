@extends('layouts.app')
@section('content')
<div class="flex flex-col p-4 w-full h-full overflow-y-auto">

    <div class="flex items-center justify-between mb-2">
    <h1 class="text-2xl font-bold">Tasks</h1>

    
        <a href="{{ route('tasks.create') }}" class="bg-[#2563EB] text-white px-4 py-2 rounded-lg hover:bg-[#1E40AF]">Add Task</a>
        
</div>

<p class="text-gray-600 mb-4">Task Management</p>
    <h2 class="text-xl font-bold mt-4">Task Overview</h2>
    <table class="w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md justify-content text-center">
        <thead class="bg-gray-200 py-2">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Script</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->script }}</td>
                    <td>
                        <x-status-badge :status="$task->status" />

                    </td>
                    <td>
                        <a href="{{ route('task-details', $task) }}">View Details</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection