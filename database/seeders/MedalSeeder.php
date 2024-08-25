<?php

namespace Database\Seeders;

use App\Models\Medal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medal::factory()->count(10)->create();
    }
}
