<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'code' => 1,
            'rank' => 0,
            'title' => fake()->sentence(4),
            'status_id' => fake()->randomElement(range(1, 3)),
        ];
    }
}
