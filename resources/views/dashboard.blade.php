@extends('layouts.app')
@section('content')
<div class="flex flex-col p-4 w-full h-full overflow-y-auto">

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p class="text-gray-600 mb-2">Monitor and Manage Your Automation Tasks</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 my-4">
        <div>
            <x-card
                title="Total Tasks"
                :value="$totalTasks"
                class="bg-white p-4 rounded-lg shadow-md"
            />
        </div>
        <div>
            <x-card
                title="Success"
                :value="$totalSuccess"
                class="bg-white p-4 rounded-lg shadow-md"
            />
        </div>
        <div>
            <x-card
                title="Failed"
                :value="$totalFailed"
                class="bg-white p-4 rounded-lg shadow-md"
            />
        </div>
    </div>
    <h2 class="text-xl font-bold mt-4">Task Overview</h2>
    <table class="w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md justify-content text-center">
        <thead class="bg-gray-200 py-2">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Script</th>
                <th>Status</th>
                <th>Schedule</th>
                <th>Last Run</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->script }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        {{ $task->scheduled_at ?? 'Not scheduled' }}
                    </td>
                    <td>
                        {{ $task->last_run_at ?? 'Not run yet' }}
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