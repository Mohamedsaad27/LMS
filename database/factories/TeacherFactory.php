<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    protected $model = Teacher::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'school_id' => $this->faker->numberBetween(1, 10),
            'hire_date' => $this->faker->date(),
            'qualification' => $this->faker->word,
            'subject_specialization' => $this->faker->word,
            'experience_years' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'photo' => $this->faker->imageUrl(),
            'salary' => $this->faker->numberBetween(100000, 1000000),
            'date_of_birth' => $this->faker->date(),
        ];
    }
}
