<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
	return response()->json(Task::all());
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
}
