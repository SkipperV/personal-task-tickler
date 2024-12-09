<?php

namespace App\Models;

use App\Enums\TaskStatuses\TaskStatusType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'allow_all_transitions',
    ];

    protected $casts = [
        'type' => TaskStatusType::class,
        'allow_all_transitions' => 'boolean',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    // Currently in work
    public function availableTransitionsTo(): BelongsToMany
    {
        return $this->belongsToMany(
            TaskStatus::class,
            'task_status_transitions',
            'to_status_id',
            'from_status_id');
    }

    public function getAvailableTransitionsFrom(): Collection
    {
        return TaskStatus::whereBelongsTo($this->space)
            ->where(function ($query) {
                $query->whereRelation('availableTransitionsTo', 'from_status_id', $this->id)
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('allow_all_transitions', true)
                            ->whereNot('id', $this->id);
                    });
            })->get();
    }

    public function getAvailableTransitionsTo(): Collection
    {
        if ($this->allow_all_transitions) {
            return $this->space->taskStatuses()->without('availableTransitionsTo')->whereNot('id', $this->id)->get(['id', 'name', 'type']);
        }
        return $this->availableTransitionsTo()->get(['id', 'name', 'type']);
    }
}
