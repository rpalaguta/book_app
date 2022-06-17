<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'iban' => $this->faker->iban,
            'year' => $this->faker->year,
            'pages' => $this->faker->numberBetween(1, 1000),
            'format' => $this->faker->randomElement(['pdf', 'html', 'book']),
            'language' => $this->faker->languageCode,
            'sku' => uniqid(),
            'image' => '1',
        ];
    }
}
