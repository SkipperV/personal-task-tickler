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
            'space_id' => 1,
            'archive_delay' => 7,
            'put_in_progress_to_the_beginning' => false,
            'put_done_to_the_end' => false,
            'show_subtasks' => false,
            'hide_all_tasks_from_global_search' => false,
            'hide_archived_from_global_search' => true,
        ];
    }
}
