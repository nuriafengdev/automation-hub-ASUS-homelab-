@extends('layouts.app')
@section('content')

<h1>Automation Hub</h1>
<table>
    <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Script</th>
            <th>Status</th>
            <th>Schedule</th>
            <th>Last Run</th>
            <th>Details</th>
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
                <td colspan="6">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection