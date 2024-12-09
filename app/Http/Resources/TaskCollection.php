<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($task) {
            return [
                'id' => $task->id,
                'status' => [
                    'id' => $task->status->id,
                    'name' => $task->status->name,
                    'type' => $task->status->type,
                ],
                'code' => $task->code,
                'rank' => $task->rank,
                'title' => $task->title,
                'is_archived' => $task->is_archived,
                'description' => $task->description,
                'deadline_at' => $task->deadline_at,
                'subtasks' => $this->when($task->total_subtasks_count > 0,
                    [
                        'total_subtasks_count' => $task->total_subtasks_count,
                        'closed_subtasks_count' => $task->closed_subtasks_count,
                    ]),
            ];
        })->toArray();
    }
}
