<?php

namespace Database\Seeders;

use App\Enums\TaskRelations\DefaultTaskRelationInwardName;
use App\Enums\TaskRelations\DefaultTaskRelationOutwardName;
use App\Enums\TaskRelations\DefaultTaskRelationType;
use App\Enums\TaskStatuses\DefaultTaskStatus;
use App\Enums\TaskStatuses\TaskStatusType;
use App\Models\Space;
use App\Models\SpaceSetting;
use App\Models\TaskRelationType;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Space::factory()->count(5)->sequence(
            [
                'user_id' => 1,
                'name' => 'Default Space',
                'position' => 1,
                'code' => 'DS',
                'slug' => 'default-space',
            ],
            [
                'user_id' => 1,
                'name' => 'Space',
                'position' => 2,
                'code' => 'SPC2',
                'slug' => 'space2',
            ],
            [
                'user_id' => 1,
                'name' => 'Movies',
                'position' => 3,
                'code' => 'MVS',
                'slug' => 'movies',
            ],
            [
                'user_id' => 2,
                'name' => 'Movies',
                'position' => 1,
                'code' => 'MVS',
                'slug' => 'movies',
            ],
            [
                'user_id' => 2,
                'name' => 'Tasks',
                'position' => 2,
                'code' => 'TSKS',
                'slug' => 'tasks',
            ]
        )->create();

        for ($i = 1; $i < 6; $i++) {
            SpaceSetting::factory()->create(['id' => $i]);
            TaskStatus::factory()->count(3)->sequence(
                [
                    'space_id' => $i,
                    'name' => DefaultTaskStatus::ToDo,
                    'type' => TaskStatusType::Pending,
                ],
                [
                    'space_id' => $i,
                    'name' => DefaultTaskStatus::InProgress,
                    'type' => TaskStatusType::Open,
                ],
                [
                    'space_id' => $i,
                    'name' => DefaultTaskStatus::Done,
                    'type' => TaskStatusType::Closed,
                ],
            )->create();

            TaskRelationType::factory()->count(3)->sequence(
                [
                    'space_id' => $i,
                    'name' => DefaultTaskRelationType::Relates,
                    'inward_name' => DefaultTaskRelationInwardName::Relates,
                    'outward_name' => DefaultTaskRelationOutwardName::Relates,
                ],
                [
                    'space_id' => $i,
                    'name' => DefaultTaskRelationType::Blocks,
                    'inward_name' => DefaultTaskRelationInwardName::Blocks,
                    'outward_name' => DefaultTaskRelationOutwardName::Blocks,
                ],
                [
                    'space_id' => $i,
                    'name' => DefaultTaskRelationType::Duplicates,
                    'inward_name' => DefaultTaskRelationInwardName::Duplicates,
                    'outward_name' => DefaultTaskRelationOutwardName::Duplicates,
                ],
                [
                    'space_id' => $i,
                    'name' => DefaultTaskRelationType::Clones,
                    'inward_name' => DefaultTaskRelationInwardName::Clones,
                    'outward_name' => DefaultTaskRelationOutwardName::Clones,
                ],
            )->create();
        }

        //Currently being tested
        DB::table('task_status_transitions')->insert([
            'space_id' => 1,
            'from_status_id' => 2,
            'to_status_id' => 3,
        ]);
    }
}
