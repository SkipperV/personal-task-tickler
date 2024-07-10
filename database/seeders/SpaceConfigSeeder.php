<?php

namespace Database\Seeders;

use App\Models\SpaceConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            SpaceConfig::factory()->create([
                'space_id' => $i,
            ]);
        }
    }
}
