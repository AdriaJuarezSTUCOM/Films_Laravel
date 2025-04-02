<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Film;

class FilmController extends Controller
{
    /**
     * Obtener todas las películas según el origen de datos.
     */
    public static function readFilms()
    {
        return Film::select('name', 'year', 'genre', 'img_url', 'country', 'duration')->get();
    }

    public function listFilms($year = null, $genre = null)
    {
        $films = collect(self::readFilms());
        $title = "Listado de todas las películas";

        // Filtrar por año si se proporciona
        if (!is_null($year)) {
            $films = $films->where('year', $year);
            $title = "Listado de películas del año $year";
        }

        // Filtrar por género si se proporciona
        if (!is_null($genre)) {
            $films = $films->filter(fn($film) => strtolower($film['genre']) === strtolower($genre));
            $title = "Listado de películas del género $genre";
        }

        // Filtrar por ambos si están presentes
        if (!is_null($year) && !is_null($genre)) {
            $title = "Listado de películas del año $year y género $genre";
        }

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    /**
     * Listar películas anteriores a un año dado (por defecto 2000).
     */
    public function listOldFilms($year = 2000)
    {
        $films = collect(self::readFilms())->where('year', '<', $year);
        return view('films.list', ["films" => $films, "title" => "Películas antes de $year"]);
    }

    /**
     * Listar películas posteriores a un año dado (por defecto 2000).
     */
    public function listNewFilms($year = 2000)
    {
        $films = collect(self::readFilms())->where('year', '>=', $year);
        return view('films.list', ["films" => $films, "title" => "Películas después de $year"]);
    }

    /**
     * Filtrar películas por año.
     */
    public function listFilmsByYear($year = null)
    {
        $films = collect(self::readFilms());
        if ($year) $films = $films->where('year', $year);
        
        return view('films.list', ["films" => $films, "title" => "Películas del año $year"]);
    }

    /**
     * Filtrar películas por género.
     */
    public function listFilmsByGenre($genre = null)
    {
        $films = collect(self::readFilms());
        if ($genre) $films = $films->filter(fn($film) => strtolower($film['genre']) === strtolower($genre));

        return view('films.list', ["films" => $films, "title" => "Películas de género $genre"]);
    }

    /**
     * Ordenar películas por año descendente.
     */
    public function sortFilms()
    {
        $films = collect(self::readFilms())->sortByDesc('year');
        return view('films.list', ["films" => $films, "title" => "Películas ordenadas por año"]);
    }

    /**
     * Contar el número de películas.
     */
    public function countFilms()
    {
        $filmNumber = collect(self::readFilms())->count();
        return view('films.filmCount', ["filmNumber" => $filmNumber, "title" => "Número de películas"]);
    }

    /**
     * Verificar si una película ya existe en la fuente de datos actual.
     */
    public function isFilm($name)
    {
        return collect(self::readFilms())->contains(fn($film) => strtolower($film["name"]) === strtolower($name));
    }

    /**
     * Crear una nueva película.
     */
    public function createFilm(Request $request)
    {
        // Validaciones
        $request->validate([
            'name' => 'required|string',
            'year' => 'required|integer|min:1900|max:2024',
            'genre' => 'required|string',
            'img_url' => 'required|url',
            'country' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        $newFilm = $request->all();

        if (Film::where('name', $newFilm['name'])->exists()) {
            return view("welcome", ["status" => "Error: La película ya existe en la BD."]);
        }
        Film::create($newFilm);

        return $this->listFilms();
    }
}
