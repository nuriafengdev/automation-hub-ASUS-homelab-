<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskRun;

class TaskController extends Controller
{
    public function index()
    {
		$tasks = Task::all();
		$totalTasks = Task::count();
		$totalSuccess = TaskRun::where('status', 'success')->count();
		$totalFailed = TaskRun::where('status', 'failed')->count();

		return view('dashboard', compact('tasks', 'totalTasks', 'totalSuccess', 'totalFailed'));
	}

    public function store(Request $request)
    {
		$task = Task::create([
			'name' => $request->name,
			'command' => $request->command,
			'script' => $request->script,
			'status' => 'pending',
		]);

		return response()->json($task, 201);
    }

	public function show(Task $task)
	{
		$task->load('runs');
		return view('task-details', compact('task'));
	}
}
