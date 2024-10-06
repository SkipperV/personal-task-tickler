<?php

namespace Database\Seeders;

use App\Models\SpaceSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            SpaceSetting::factory()->create([
                'space_id' => $i,
            ]);
        }
    }
}
