<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
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
            'date_of_birth' => $this->faker->date(),
            'enrollment_date' => $this->faker->date(),
            'grade' => $this->faker->numberBetween(1, 10),
            'parent_contact' => $this->faker->phoneNumber(),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
