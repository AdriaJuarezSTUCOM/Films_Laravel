<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class ActorController extends Controller
{
    public function readActors(){

        $actors = DB::table("actors")->select("name")->get()->map(function ($actor) {
            return (array) $actor;
        })->toArray();

        return $actors;
    }

    public function listActors()
    {
        $title = "Listado de actores";

        

        return view("actors.listActors", ["actors" => null, "title" => $title]);
    }

    public function listActorsByDecade($year = null)
    {
        $films_sorted = [];

        $title = "Listado de todas las pelis ordenadas x año";
        $films = FilmController::readFilms();

        $films_sorted = collect($films)->sortByDesc('year');

        return view("films.list", ["films" => $films_sorted, "title" => $title]);
    }

    public function countActors()
    {
        $title = "Número de actores";

        //$filmNumber = collect($films)->count();
        
        return view("actors.actorCount", ["actorNumber" => null, "title" => $title]);
    }

}