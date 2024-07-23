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

        return [
            'id' => $this->id,
            'status' => $this->status,
            'code' => $this->code,
            'title' => $this->title,
            'is_archived' => $this->is_archived,
            'description' => $this->description,
            'deadline_at' => $this->deadline_at,
            'space' => [
                $space->name,
                $space->slug
            ],
        ];
    }
}
