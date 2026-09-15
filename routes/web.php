<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function() {
    $tasks = Task::all();
	return view('dashboard', compact('tasks'));
});

Route::get('/dashboard/task/{task}', [TaskController::class, 'show'])->name('task-details');
