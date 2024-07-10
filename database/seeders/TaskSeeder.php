<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 2; $i++) {
            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i * 3,
                'id_within_space' => 1,
                'rank' => 1,
                'title' => 'First Task',
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i,
                'id_within_space' => 2,
                'rank' => 2,
                'title' => 'Done task',
                'done_at' => now(),
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i,
                'id_within_space' => 3,
                'rank' => 3,
                'title' => 'Done task 10 days ago',
                'done_at' => now()->subDays(10),
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i * 3,
                'id_within_space' => 4,
                'rank' => 4,
                'title' => 'Blocked task',
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i * 2,
                'id_within_space' => 5,
                'rank' => 5,
                'title' => 'Blocking task',
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i * 3,
                'id_within_space' => 6,
                'rank' => 6,
                'title' => 'Task with subtasks',
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i * 3,
                'id_within_space' => 7,
                'rank' => 7,
                'title' => 'Subtask 1',
            ]);

            Task::factory()->create([
                'space_id' => $i,
                'status_id' => $i * 3,
                'id_within_space' => 8,
                'rank' => 8,
                'title' => 'Subtask 2',
            ]);
        }
        DB::table('task_relations')->insert([
            'parent_task_id' => 4,
            'child_task_id' => 5,
            'type' => 'Blocked by'
        ]);
        DB::table('task_relations')->insert([
            'parent_task_id' => 12,
            'child_task_id' => 13,
            'type' => 'Blocked by'
        ]);

        DB::table('task_relations')->insert([
            'parent_task_id' => 6,
            'child_task_id' => 7,
            'type' => 'Subtask'
        ]);
        DB::table('task_relations')->insert([
            'parent_task_id' => 6,
            'child_task_id' => 8,
            'type' => 'Subtask'
        ]);
        DB::table('task_relations')->insert([
            'parent_task_id' => 14,
            'child_task_id' => 15,
            'type' => 'Subtask'
        ]);
        DB::table('task_relations')->insert([
            'parent_task_id' => 14,
            'child_task_id' => 16,
            'type' => 'Subtask'
        ]);
    }
}
