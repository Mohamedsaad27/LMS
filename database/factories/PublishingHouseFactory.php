<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class PublishingHouseFactory extends Factory
{
    protected $model = Organization::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'logo' => $this->faker->imageUrl(),
            'established_year' => $this->faker->year(),
            'description_en' => $this->faker->text(),
            'description_ar' => $this->faker->text(),
            'total_books' => $this->faker->numberBetween(1, 10),
        ];
    }
}
