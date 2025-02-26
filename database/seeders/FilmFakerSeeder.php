<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert([
                'name' => $faker->sentence(3),
                'year' => $faker->year,
                'genre' => $faker->randomElement(['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi']),
                'country' => substr($faker->country, 0, 30),
                'duration' => $faker->numberBetween(80, 180),
                'img_url' => $faker->imageUrl(200, 300, 'movies'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
