<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        User::create([
            'name_ar'=> 'محمد عادل',
            'name_en' => 'Mohamed Adel',
            'email' => 'admin@gmail.com',
            'password' => 'admin@123',
            'user_type' => 'admin',
            'is_verified' => 1,
        ]);

        // User::factory()->count(20)->create();
    }
}
