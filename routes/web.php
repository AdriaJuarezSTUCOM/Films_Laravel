<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('year')->group(function() {
        Route::group(['prefix'=>'filmout'], function(){
            // Routes included with prefix "filmout"
            Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
            Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
            Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
            Route::get('filmsByYear/{year?}',[FilmController::class, "listFilmsByYear"])->name('filmsByYear');
            Route::get('filmsByGenre/{genre?}',[FilmController::class, "listFilmsByGenre"])->name('filmsByGenre');
            Route::get('sortFilms/',[FilmController::class, "sortFilms"])->name('sortFilms');
            Route::get('countFilms/',[FilmController::class, "countFilms"])->name('countFilms');
        });
    });

    Route::middleware('year')->group(function() {
        Route::group(['prefix'=>'actorout'], function(){
            // Routes included with prefix "filmout"
            Route::get('actors/',[ActorController::class, "listActors"])->name('actors');
            Route::post('listActorsByDecade/{year?}',[ActorController::class, "listActorsByDecade"])->name('listActorsByDecade');
            Route::get('countActors/',[ActorController::class, "countActors"])->name('countActors');
        });
    });

    Route::middleware('url')->group(function() {
        Route::group(['prefix'=>'filmin'], function(){
            // Routes included with prefix "filmin"
            Route::post('createFilm/',[FilmController::class, "createFilm"])->name('createFilm');
        });
    });
});

require __DIR__.'/auth.php';
