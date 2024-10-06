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
                'status' => $task->status,
                'code' => $task->code,
                'rank' => $task->rank,
                'title' => $task->title,
                'is_archived' => $task->is_archived,
                'description' => $task->description,
                'deadline_at' => $task->deadline_at,
            ];
        })->toArray();
    }
}
