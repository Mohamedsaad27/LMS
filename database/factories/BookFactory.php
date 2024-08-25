<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->word(),
            'author' => $this->faker->name(),
            'publication_year' => $this->faker->year(),
            'cover_image' => $this->faker->imageUrl(),
            'description' => $this->faker->text(),
        ];
    }
}
