<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {
        $films_filteredByYear = [];

        $title = "Listado de todas las pelis filtrado x año";
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year)){
            return view('films.list', ["films" => $films, "title" => $title]);
        }else{
            foreach($films as $film){
                if($film["year"] == $year){
                    $films_filteredByYear[] = $film;
                }
            }
        }

        return view("films.list", ["films" => $films_filteredByYear, "title" => $title]);
    }

    public function listFilmsByGenre($genre = null)
    {
        $films_filteredByGenre = [];

        $title = "Listado de todas las pelis filtrado x género";
        $films = FilmController::readFilms();

        //if genre is null
        if (is_null($genre)){
            return view('films.list', ["films" => $films, "title" => $title]);
        }else{
            foreach($films as $film){
                if($film["genre"] == $genre){
                    $films_filteredByGenre[] = $film;
                }
            }
        }

        return view("films.list", ["films" => $films_filteredByGenre, "title" => $title]);
    }

    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function sortFilms()
    {
        $films_sorted = [];

        $title = "Listado de todas las pelis ordenadas x año";
        $films = FilmController::readFilms();

        $films_sorted = collect($films)->sortByDesc('year');

        return view("films.list", ["films" => $films_sorted, "title" => $title]);
    }

    public function countFilms()
    {
        $title = "Número de pelis";
        $films = FilmController::readFilms();

        $filmNumber = collect($films)->count();
        
        return view("films.filmCount", ["filmNumber" => $filmNumber, "title" => $title]);
    }

    public function isFilm($name)
    {
        $films = FilmController::readFilms();
        // Verificar si la película ya existe (basado en el título y el año)
        foreach ($films as $film) {
            if (strtolower($film["name"]) === strtolower($name)) {
                return true;
            }
        }
        return false;
    }

    public function createFilm(Request $request)
{
    // Leer las películas actuales
    $films = FilmController::readFilms();

    // Convertir la solicitud en un array
    $newFilm = $request->toArray();

    // Validar que el año esté en el rango 1900-2024
    if ($newFilm["year"] < 1900 || $newFilm["year"] > 2024) {
        return view("welcome", ["status" => "Error: El año debe estar entre 1900 y 2024."]);
    }

    // Comprobar si la película existe
    if ($this->isFilm($newFilm["name"])) {
        return view("welcome", ["status" => "Error: La película ya existe."]);
    }

    // Agregar la nueva película
    $films[] = $newFilm;

    // Guardar el array actualizado en el archivo JSON
    Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT));

    return $this->listFilms();
}


}