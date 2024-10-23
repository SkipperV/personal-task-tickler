<?php

namespace Database\Factories;

use App\Models\TaskRelation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskRelation>
 */
class TaskRelationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inward_task_id' => 1,
            'outward_task_id' => 2,
            'type_id' => 1,
        ];
    }
}
