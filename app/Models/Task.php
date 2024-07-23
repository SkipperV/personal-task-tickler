<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'status_id',
        'code',
        'rank',
        'title',
        'is_archived',
        'description',
        'deadline_at',
        'done_at',
    ];

    protected $appends = [
        'status',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'deadline_at' => 'datetime:d-m-Y H:i',
        'done_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        $spaceCode = explode('-', $value)[0];

        try {
            return $this->whereHas('space', function ($query) use ($spaceCode) {
                $query->where('user_id', request()->user()->id)->where('code', $spaceCode);
            })->where('code', $value)->with('space')->first();
        } catch (ModelNotFoundException $e) {
            return abort(404, 'Task not found.');
        }
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class)->without('configuration');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
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

    public function getStatusAttribute(): string
    {
        if ($this->relationLoaded('status')) {
            return $this->status->name;
        }
        return $this->status()->first()->name;
    }
}
