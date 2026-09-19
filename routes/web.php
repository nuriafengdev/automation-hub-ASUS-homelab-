<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::post('/dashboard/task', [TaskController::class, 'store'])->name('task-store');

Route::get('/dashboard/task/{task}', [TaskController::class, 'show'])->name('task-details');
