<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            TaskStatus::factory()->create([
                'space_id' => $i,
                'name' => 'Done'
            ]);
            TaskStatus::factory()->create([
                'space_id' => $i,
                'name' => 'In progress'
            ]);
            TaskStatus::factory()->create([
                'space_id' => $i,
                'name' => 'To do'
            ]);
        }
    }
}
