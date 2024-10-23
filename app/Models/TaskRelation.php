<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskRelation extends Pivot
{
    use HasFactory;

    protected $table = 'task_relations';

    public function relationType(): BelongsTo
    {
        return $this->belongsTo(TaskRelationType::class, 'type_id');
    }
}
