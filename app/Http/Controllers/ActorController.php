<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function readActors(){

        return Actor::select("name", "surname", "birthdate", "country", "img_url")->get();

    }

    public function listActors()
    {
        $title = "Listado de actores";

        $actors = ActorController::readActors();

        return view("actors.listActors", ["actors" => $actors, "title" => $title]);
    }

    public function listActorsByDecade(Request $request)
    {
        $title = "Listado de actores por década";
        $year = $request->input('year'); // Obtener el año desde el formulario

        // Si no hay año en la petición, mostrar todos los actores
        if (!$year) {
            $actors = DB::table("actors")->select("name", "surname", "birthdate", "country", "img_url")->get();
            return view('actors.listActors', ["actors" => $actors, "title" => $title]);
        }

        // Obtener la década seleccionada
        $startYear = $year;
        $endYear = $year + 9;

        // Filtrar actores nacidos en la década
        $actors = DB::table("actors")
                    ->select("name", "surname", "birthdate", "country", "img_url")
                    ->whereBetween('birthdate', ["$startYear-01-01", "$endYear-12-31"])
                    ->get();

        return view("actors.listActors", ["actors" => $actors, "title" => $title]);
    }


    public function countActors()
    {
        $title = "Número de actores";

        $actorNumber = collect(ActorController::readActors())->count();

        return view("actors.actorCount", ["actorNumber" => $actorNumber, "title" => $title]);
    }

    public function destroy($id)
    {
        $actor = Actor::where("id", $id)->first();

        if (!$actor) {
            return response()->json([
                "action" => "delete",
                "status" => false,
                "message" => "Actor no encontrado"
            ], 404);
        }

        $deleted = Actor::where("id", $id)->delete();

        return response()->json([
            "action" => "delete",
            "status" => $deleted ? true : false
        ]);
    }
public function index()
    {
        $actors = Actor::select('id', 'name', 'surname', 'birthdate', 'country', 'img_url')->get();

        return response()->json([
            "action" => "index",
            "status" => true,
            "actors" => $actors
        ]);
    }
}