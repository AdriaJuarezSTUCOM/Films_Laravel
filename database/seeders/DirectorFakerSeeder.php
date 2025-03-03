<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DirectorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('directors')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date('Y-m-d', '-30 years'), // Mínimo 30 años de edad
                'country' => substr($faker->country, 0, 30), // Evitar error por longitud
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
