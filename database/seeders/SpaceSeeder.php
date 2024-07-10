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
            'code' => 'DS',
            'slug' => 'default-space',
        ]);

        Space::factory()->create([
            'user_id' => 1,
            'name' => 'Space',
            'code' => 'SPC2',
            'slug' => 'space2',
        ]);

        Space::factory()->create([
            'user_id' => 1,
            'name' => 'Movies',
            'code' => 'MVS',
            'slug' => 'movies',
        ]);

        Space::factory()->create([
            'user_id' => 2,
            'name' => 'Movies',
            'code' => 'MVS',
            'slug' => 'movies',
        ]);

        Space::factory()->create([
            'user_id' => 2,
            'name' => 'Tasks',
            'code' => 'TSKS',
            'slug' => 'tasks',
        ]);
    }
}
