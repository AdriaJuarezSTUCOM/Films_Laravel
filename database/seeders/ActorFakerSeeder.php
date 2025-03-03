<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date('Y-m-d', '-20 years'), // Mínimo 20 años de edad
                'country' => substr($faker->country, 0, 30), // Evitar error por longitud
                'img_url' => $faker->imageUrl(200, 300, 'people'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
