@extends('layouts.app')
@section('content')
<body>
    <h1>Create Task</h1>
    <form action="{{ route('task-store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Create Task</button>
    </form>
</body>
@endsection