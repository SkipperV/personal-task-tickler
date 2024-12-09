<?php

namespace App\Models;

use App\Enums\TaskStatuses\TaskStatusType;
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

    protected $with = [
        'status',
    ];

    //Will be reviewed
    protected static function booted()
    {
        static::addGlobalScope('withSubtasksCounts', function ($query) {
            $query->withCount([
                'subtasks as total_subtasks_count',
                'subtasks as closed_subtasks_count' => function ($query) {
                    $query->whereRelation('status', 'type', TaskStatusType::Closed);
                }
            ]);
        });
    }

    //Will be reviewed
    public function resolveRouteBinding($value, $field = null)
    {
        $spaceCode = explode('-', $value)[0];
        try {
            return $this->whereHas('space', function ($query) use ($spaceCode) {
                $query->where('user_id', request()->user()->id)
                    ->where('code', $spaceCode);
            })
                ->where('code', $value)
                ->with(['space', 'inwardRelations', 'outwardRelations'])
                ->first();
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found.'], Response::HTTP_NOT_FOUND);
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
            ->as('relation')
            ->using(TaskRelation::class)
            ->withPivot('type_id');
    }

    public function outwardRelations(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'outward_task_id', 'inward_task_id')
            ->as('relation')
            ->using(TaskRelation::class)
            ->withPivot('type_id');
    }

    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_task_id')
            ->withoutGlobalScope('withSubtasksCounts');
    }

    //Currently testing approach of leaving business logic in Models classes
    public function groupedRelations()
    {
        $inwardRelationsGroups = $this->inwardRelations
            ->groupBy(function ($relation) {
                return $relation->relation->relationType->inward_name;
            });
        $outwardRelationsGroups = $this->outwardRelations
            ->groupBy(function ($relation) {
                return $relation->relation->relationType->outward_name;
            });

        $mergedRelations = $inwardRelationsGroups->map(function ($inwardRelationsGroup, $key) use ($outwardRelationsGroups) {
            return $inwardRelationsGroup->merge($outwardRelationsGroups->get($key, collect()));
        });

        foreach ($outwardRelationsGroups as $key => $outwardRelationsGroup) {
            if (!$mergedRelations->has($key)) {
                $mergedRelations[$key] = $outwardRelationsGroup;
            }
        }

        return $mergedRelations;
    }
}
