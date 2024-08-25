<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    protected $model = Subject::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade_id' => $this->faker->numberBetween(1, 10),
            'teacher_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
