<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
use App\Models\Film;

class ActorFilmSeeder extends Seeder
{
    public function run(): void
    {
        $films = Film::all();
        $actors = Actor::all();

        foreach ($actors as $actor) {
            $actor->films()->attach(
                $films->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
