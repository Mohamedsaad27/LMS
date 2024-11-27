<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalStagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            ['name_en' => 'Primary', 'name_ar' => 'الابتدائية'],
            ['name_en' => 'Middle', 'name_ar' => 'الإعدادية'],
            ['name_en' => 'Secondary', 'name_ar' => 'الثانوية'],
        ];

        foreach ($stages as $stage) {
            DB::table('educational_stages')->insert([
                'name_en' => $stage['name_en'],
                'name_ar' => $stage['name_ar'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
