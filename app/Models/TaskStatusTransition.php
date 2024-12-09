<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskStatusTransition extends Pivot
{
    public $timestamps = false;

    protected $table = 'task_status_transitions';

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }
}
