<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task {{ $task->id }}</title>
</head>
<body>
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
                <th>Finished At</th>
                <th>Output</th>
            </tr>
        </thead>
        @forelse ($task->runs as $run)
            <tr>
                <td>{{ $run->id }}</td>
                <td>{{ $run->status }}</td>
                <td>{{ $run->started_at ?? 'Not started' }}</td>
                <td>{{ $run->finished_at ?? 'Not finished' }}</td>
                <td>{{ $run->output ?? 'No output' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No runs found for this task.</td>
            </tr>
        @endforelse
    </table>
</body>
</html>