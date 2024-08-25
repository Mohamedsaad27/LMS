<?php

namespace Database\Seeders;

use App\Models\EducationalStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationalStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EducationalStage::factory()->count(10)->create();
    }
}
