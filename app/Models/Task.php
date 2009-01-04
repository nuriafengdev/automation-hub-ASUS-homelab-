<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $fillable = [
	'name',
	'command',
	'script',
	'status',
	'scheduled_at',
	'last_run_at',
	'output',
    ];

    public function runs(): HasMany
    {
	return $this->hasMany(TaskRun::class);
    }
}
