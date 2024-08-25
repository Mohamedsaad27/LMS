<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = ['admin','student','teacher','publishing_house','school'];

        foreach ($userTypes as $userType) {
            UserType::create(['type' => $userType]);
        }
    }
}
