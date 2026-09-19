@extends('layouts.app')
@section('content')
<div class="flex flex-col p-4 w-full h-full overflow-y-auto">

    <h1 class="text-2xl font-bold mb-4">Task {{ $task->id }}</h1>
    
    <table class="hidden md:table w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md text-center">
        <thead class="bg-gray-200 py-2">
            <tr>
                <th>Task</th>
                <th>Script</th>
                <th>Status</th>
                <th>Schedule At</th>
                <th>Last Run</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->script }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->scheduled_at ?? 'Not scheduled' }}</td>
                    <td>{{ $task->last_run_at ?? 'Not run yet' }}</td>
                </tr>
        </tbody>
    </table>
    <div class="md:hidden mt-4 border border-[#E2E8F0] rounded-lg p-4 shadow-md">
        <div class="space-y-3">
            <p>
                <strong>Task:</strong>
                {{ $task->name }}
            </p>

            <p>
                <strong>Script:</strong>
                {{ $task->script }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $task->status }}
            </p>

            <p>
                <strong>Schedule At:</strong>
                {{ $task->scheduled_at ?? 'Not scheduled' }}
            </p>

            <p>
                <strong>Last Run:</strong>
                {{ $task->last_run_at ?? 'Not run yet' }}
            </p>
        </div>
    </div>
    <h2 class="text-xl font-bold mt-4">Task History</h2>
    <div class="space-y-4 mt-4">

        <table class="hidden md:table w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md text-center">
            <thead class="bg-gray-200 py-2">
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Started At</th>
                    <th>Duration</th>
                    <th>Finished At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($task->runs as $run)
            @php
                $startedAt = $run->started_at ? \Carbon\Carbon::parse($run->started_at) : null;
                $finishedAt = $run->finished_at ? \Carbon\Carbon::parse($run->finished_at) : null;
    
                $duration = $startedAt && $finishedAt
                ? number_format($finishedAt->diffInMicroseconds($startedAt) / 1000, 2) . ' ms'
                : null;
            @endphp
            
                <tr>
                    <td>{{ $run->id }}</td>
                    <td>
                        <x-status-badge :status="$run->status" />
                    </td>
                    <td>{{ $startedAt ?? 'Not started' }}</td>
                    <td>{{ $duration ?? 'Not completed' }}</td>
                    <td>{{ $finishedAt ?? 'Not finished' }}</td>
                    <td>
                        <a href="{{ route('runs.output', $run->id) }}" class="text-blue-600 hover:text-blue-800">View Output</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No runs found for this task.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="md:hidden space-y-2">
            @forelse ($task->runs as $run)
            @php
                $startedAt = $run->started_at ? \Carbon\Carbon::parse($run->started_at) : null;
                $finishedAt = $run->finished_at ? \Carbon\Carbon::parse($run->finished_at) : null;
    
                $duration = $startedAt && $finishedAt
                ? number_format($finishedAt->diffInMicroseconds($startedAt) / 1000, 2) . ' ms'
                : null;
            @endphp
                <div class="border border-[#E2E8F0] rounded-lg p-4 shadow-md">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-semibold">
                            Run #{{ $run->id }}
                        </span>

                        <x-status-badge :status="$run->status" />
                    </div>

                    <div class="space-y-2 text-sm">
                        <p>
                            <strong>Started At:</strong>
                            {{ $startedAt ?? 'Not started' }}
                        </p>

                        <p>
                            <strong>Duration:</strong>
                            {{ $duration ?? 'Not completed' }}
                        </p>

                        <p>
                            <strong>Finished At:</strong>
                            {{ $finishedAt ?? 'Not finished' }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <a
                            href="{{ route('runs.output', $run->id) }}"
                            class="text-blue-600 hover:text-blue-800"
                        >
                            View Output
                        </a>
                    </div>
                </div>
            @empty
                <p>No runs found for this task.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection