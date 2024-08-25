<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    protected $model = School::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'publishing_house_id' => $this->faker->numberBetween(1, 10),
            'established_year' => $this->faker->date(),
            'description' => $this->faker->text(),
            'student_count' => $this->faker->numberBetween(1, 10),
            'teacher_count' => $this->faker->numberBetween(1, 10),
            'logo' => $this->faker->imageUrl(),
            'type' => $this->faker->randomElement(['primary','secondary','high_school']),
        ];
    }
}
