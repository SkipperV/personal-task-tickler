<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskRelation;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaceCodesForSeeding = ['DS-', 'SPC2-'];

        for ($i = 1; $i <= 2; $i++) {
            Task::factory()->count(8)->sequence(
                [
                    'space_id' => $i,
                    'status_id' => $i,
                    'code' => $spaceCodesForSeeding[$i - 1] . '1',
                    'rank' => 1,
                    'title' => 'First Task',
                ],
                [
                    'space_id' => $i,
                    'status_id' => $i * 3,
                    'code' => $spaceCodesForSeeding[$i - 1] . '2',
                    'rank' => 2,
                    'title' => 'Done task',
                    'done_at' => now(),
                ],
                [
                    'space_id' => $i,
                    'status_id' => $i,
                    'code' => $spaceCodesForSeeding[$i - 1] . '3',
                    'rank' => 3,
                    'title' => 'Done task 10 days ago',
                    'done_at' => now()->subDays(10),
                ],
                [
                    'space_id' => $i,
                    'status_id' => $i * 3,
                    'code' => $spaceCodesForSeeding[$i - 1] . '4',
                    'rank' => 4,
                    'title' => 'Blocked task',
                ],
                [
                    'space_id' => $i,
                    'status_id' => $i * 2,
                    'code' => $spaceCodesForSeeding[$i - 1] . '5',
                    'rank' => 5,
                    'title' => 'Blocking task',
                ],
                [
                    'space_id' => $i,
                    'status_id' => $i * 3,
                    'code' => $spaceCodesForSeeding[$i - 1] . '6',
                    'rank' => 6,
                    'title' => 'Task with subtasks',
                ],
                [
                    'space_id' => $i,
                    'parent_task_id' => $i * 6,
                    'status_id' => $i * 3,
                    'code' => $spaceCodesForSeeding[$i - 1] . '7',
                    'rank' => 7,
                    'title' => 'Subtask 1',
                ],
                [
                    'space_id' => $i,
                    'parent_task_id' => $i * 6,
                    'status_id' => $i * 3,
                    'code' => $spaceCodesForSeeding[$i - 1] . '8',
                    'rank' => 8,
                    'title' => 'Subtask 2',
                ]
            )->create();

            TaskRelation::factory()->create([
                'inward_task_id' => ($i - 1) * 8 + 4,
                'outward_task_id' => ($i - 1) * 8 + 5,
                'type_id' => ($i - 1) * 4 + 2
            ]);
        }
    }
}
