<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class ActorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'birthdate' => $this->faker->date('Y-m-d', now()),
            'country' => $this->faker->country(),
            'img_url' => $this->faker->imageUrl(200, 300, 'people'),
        ];
    }
}
