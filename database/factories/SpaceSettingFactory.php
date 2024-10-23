<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpaceSetting>
 */
class SpaceSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 1,
            'archive_delay' => -1,
            'show_open_tasks_on_top' => false,
            'show_closed_tasks_on_bottom' => false,
            'collapse_subtasks' => true,
            'hide_from_global_search' => 1,
        ];
    }
}
