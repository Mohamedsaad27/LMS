<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EducationalStagesSeeder::class,
            // UserTypeSeeder::class,
            // PublishingHouseSeeder::class,
            // SchoolSeeder::class,
            // TeacherSeeder::class,
            // StudentSeeder::class,
            // EducationalStageSeeder::class,
            // GradeSeeder::class,
            // ClassRoomSeeder::class,
            // SubjectSeeder::class,
            // BookSeeder::class,
            // MedalSeeder::class,
            // BadgeSeeder::class,
        ]);
    }
}
