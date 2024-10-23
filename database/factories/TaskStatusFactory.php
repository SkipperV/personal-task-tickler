<?php

namespace Database\Factories;

use App\Enums\TaskStatuses\DefaultTaskStatus;
use App\Enums\TaskStatuses\TaskStatusType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskStatus>
 */
class TaskStatusFactory extends Factory
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
            'name' => DefaultTaskStatus::ToDo,
            'type' => TaskStatusType::Pending,
        ];
    }
}
