<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $space = $this->space;
        $status = $this->status;

        return [
            'id' => $this->id,
            'space' => new SpaceResource($space),
            'status' => [
                'id' => $status->id,
                'name' => $status->name,
                'type' => $status->type,
            ],
            'code' => $this->code,
            'title' => $this->title,
            'is_archived' => $this->is_archived,
            'description' => $this->description,
            'deadline_at' => $this->deadline_at,
            'subtasks' => $this->when($this->total_subtasks_count > 0,
                [
                    'total_subtasks_count' => $this->total_subtasks_count,
                    'closed_subtasks_count' => $this->closed_subtasks_count,
                    'data' => new TaskCollection($this->subtasks),
                ]),
            'relations' => $this->groupedRelations()->map(function ($relation) {
                return new TaskCollection($relation);
            }),
        ];
    }
}
