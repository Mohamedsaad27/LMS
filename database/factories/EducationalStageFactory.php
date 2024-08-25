<?php

namespace Database\Factories;

use App\Models\EducationalStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationalStage>
 */
class EducationalStageFactory extends Factory
{
     protected $model = EducationalStage::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'school_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
