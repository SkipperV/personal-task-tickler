<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Response;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'rank',
        'title',
        'is_archived',
        'description',
        'deadline_at',
        'done_at',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'deadline_at' => 'datetime:d-m-Y H:i',
        'done_at' => 'datetime:d-m-Y H:i',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        $spaceCode = explode('-', $value)[0];
        try {
            return $this->whereHas('space', function ($query) use ($spaceCode) {
                $query->where('user_id', request()->user()->id)->where('code', $spaceCode);
            })->where('code', $value)->with(['space', 'status'])->first();
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found.'], Response::HTTP_NOT_FOUND);
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

    public function inwardRelations(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'inward_task_id', 'outward_task_id')
            ->as('relations')
            ->using(TaskRelation::class)
            ->withPivot('type_id');
    }

    public function outwardRelations(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'outward_task_id', 'inward_task_id')
            ->as('relations')
            ->using(TaskRelation::class)
            ->withPivot('type_id');
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }
}
