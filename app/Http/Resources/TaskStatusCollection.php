<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskStatusCollection extends ResourceCollection
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($status) {
            return [
                'id' => $status->id,
                'name' => $status->name,
                'type' => $status->type,
                $this->mergeWhen($status->relationLoaded('availableTransitionsTo'), [
                    'allow_all_transitions' => $status->allow_all_transitions,
                    'available_transitions_to' => new TaskStatusCollection($status->getAvailableTransitionsTo())
                ])
            ];
        })->toArray();
    }
}
