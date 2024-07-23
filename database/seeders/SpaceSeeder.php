<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Space::factory()->create([
            'user_id' => 1,
            'name' => 'Default Space',
            'position' => 1,
            'code' => 'DS',
            'slug' => 'default-space',
        ]);

        Space::factory()->create([
            'user_id' => 1,
            'name' => 'Space',
            'position' => 2,
            'code' => 'SPC2',
            'slug' => 'space2',
        ]);

        Space::factory()->create([
            'user_id' => 1,
            'name' => 'Movies',
            'position' => 3,
            'code' => 'MVS',
            'slug' => 'movies',
        ]);

        Space::factory()->create([
            'user_id' => 2,
            'name' => 'Movies',
            'position' => 1,
            'code' => 'MVS',
            'slug' => 'movies',
        ]);

        Space::factory()->create([
            'user_id' => 2,
            'name' => 'Tasks',
            'position' => 2,
            'code' => 'TSKS',
            'slug' => 'tasks',
        ]);
    }
}
