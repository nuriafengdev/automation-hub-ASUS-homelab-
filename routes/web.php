<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::get('/dashboard/task/{task}', [TaskController::class, 'show'])->name('task-details');

Route::post('/tasks', [TaskController::class, 'store'])->name('task-store');
Route::get('/tasks', [TaskController::class, 'showTasks'])->name('tasks');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::get('/task-details/{taskRun}', [TaskController::class, 'showOutput'])->name('runs.output');

