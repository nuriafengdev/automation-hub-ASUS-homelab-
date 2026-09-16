@extends('layouts.app')
@section('content')
    <h1>Task {{ $task->id }}</h1>
    
    <table>
        <thead>
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
    <h2>Task History</h2>
    <table>
        <thead>
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
                    @if ($run->status === 'success') 
                        <span class="text-green-600">Success</span>
                    @elseif ($run->status === 'failed')
                        <span class="text-red-600">Failed</span>
                    @elseif ($run->status === 'running') 
                        <span class="text-blue-600">Running</span>
                    @else
                        <span class="text-gray-600">{{ ucfirst($run->status) }}</span>
                    @endif
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
@endsection