<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'id_within_space',
        'rank',
        'title',
        'status_id',
        'deadline_at',
        'done_at',
        'description',
    ];

    protected $hidden = [
        'status_id'
    ];

    protected $appends = [
        'code',
        'status'
    ];

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function getCodeAttribute(): string
    {
        return $this->space->code . "-" . $this->id_within_space;
    }

    public function getStatusAttribute(): string
    {
        return $this->status->name;
    }

    public function blockedBy(): BelongsToMany|bool
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'child_task_id', 'parent_task_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Blocked by')
            ?? false;
    }

    public function isBlocking(): BelongsToMany|bool
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'parent_task_id', 'child_task_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Blocked by')
            ?? false;
    }

    public function subtasks(): BelongsToMany|bool
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'child_task_id', 'parent_task_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Subtask')
            ?? false;
    }

    public function parentTask(): BelongsToMany|bool
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'parent_task_id', 'child_task_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Subtask')
            ?? false;
    }
}
