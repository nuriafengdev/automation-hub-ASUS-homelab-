<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskRun extends Model
{
    protected $fillable = [
	'task_id',
	'status',
	'output',
	'started_at',
	'finished_at',
    ];

    public function task(): BelongsTo
    {
	return $this->belongsTo(Task::class);
    }
}
