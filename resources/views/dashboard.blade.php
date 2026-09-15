<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
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
</body>
</html>