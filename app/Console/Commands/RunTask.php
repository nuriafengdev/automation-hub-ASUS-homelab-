<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\TaskRun;

#[Signature('tasks:run {task_id} {--force}')]
#[Description('Command description')]
class RunTask extends Command
{
    protected $signature = 'tasks:run {task_id} {--force}';

    protected $description = 'Run the task and save the result';
    /**
     * Execute the console command.
     */
    public function handle()
    {
    	$this->info('Task initiated');
    	
        $taskId = $this->argument('task_id');
	$force = $this->option('force');
	
        $task = Task::find($taskId);
        if (!$task) {
		$this->error('Task not found!');
		return Command::FAILURE;
        }
	if (!$this->option('force')) {
	        if (!$force && !$this->confirm("Do you really want to run '{$task->name}'?")) {
			$this->info('Command cancelled');
			return Command::SUCCESS;
	        }
        }
	$task->status = 'running';

	$script = getenv('HOME') . '/homelab/scripts/' . $task->script;
	
	if (empty($task->script)) {
	throw new \RuntimeException('The task has not a defined script.');
	}
	
	if (!file_exists($script)) {
	throw new \RuntimeException('The script does not exist: {$script}');
	}	
	
	$runTask = TaskRun::create([
		'task_id' => $task->id,
		'status' => 'running',
		'started_at' => now(),
	]);
	
    	try {
		
	$lines = [];
	$exitCode = 0;

	exec($script, $lines, $exitCode);
	$output = implode(PHP_EOL, $lines);

	
	if ($exitCode == 0) {
		$runTask->status = 'success';
		$this->info('Task Completed Successfully');
	} else {
		$runTask->status = 'failed';
		$this->info('Task Failed.');
	}

	$runTask->output = $output;
	$runTask->finished_at = now();
	$runTask->save();
	$this->line($output);
	
	return $exitCode === 0
		? Command::SUCCESS
		: Command::FAILURE;
		
    	} catch (\Throwable $e) {
    		$runTask->status = 'failed';
    		$runTask->output = $e->getMessage();
		return Command::FAILURE;
    	}
    	
    }
}
