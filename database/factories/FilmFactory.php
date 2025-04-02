<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'year' => $this->faker->numberBetween(1970, 2024),
            'genre' => $this->faker->randomElement(['Acción', 'Comedia', 'Drama', 'Terror', 'Ciencia Ficción']),
            'img_url' => $this->faker->imageUrl(200, 300, 'movies'),
            'country' => $this->faker->country,
            'duration' => $this->faker->numberBetween(80, 180),
        ];
    }
}
