<?php

namespace Database\Factories;

use App\Enums\TaskRelations\DefaultTaskRelationInwardName;
use App\Enums\TaskRelations\DefaultTaskRelationOutwardName;
use App\Enums\TaskRelations\DefaultTaskRelationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskRelationType>
 */
class TaskRelationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'space_id' => 1,
            'name' => DefaultTaskRelationType::Relates,
            'inward_name' => DefaultTaskRelationInwardName::Relates,
            'outward_name' => DefaultTaskRelationOutwardName::Relates,
        ];
    }
}
