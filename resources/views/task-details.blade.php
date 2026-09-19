@extends('layouts.app')
@section('content')
<div class="flex flex-col p-4 w-full h-full overflow-y-auto">

    <h1 class="text-2xl font-bold mb-4">Task {{ $task->id }}</h1>
    
    <table class="w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md justify-content text-center">
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
    <h2 class="text-xl font-bold mt-4">Task History</h2>
    <table class="w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md justify-content text-center">
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
                    <x-status-badge :status="$task->status" />
                </td>
                <td>{{ $startedAt ?? 'Not started' }}</td>
                <td>{{ $duration ?? 'Not completed' }}</td>
                <td>{{ $finishedAt ?? 'Not finished' }}</td>
                <td>
                    {{--<a href="{{ route('runs.output', $run->id) }}" class="text-blue-600 hover:text-blue-800">View Output</a>  --}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No runs found for this task.</td>
            </tr>
        @endforelse
    </table>
</div>
@endsection