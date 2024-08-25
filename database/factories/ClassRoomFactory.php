<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassRoom>
 */
class ClassRoomFactory extends Factory
{
    protected $model = ClassRoom::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'capacity' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text(),
        ];
    }
}
