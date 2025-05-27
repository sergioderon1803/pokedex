<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

// Default routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Pokemon routes
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::get('/pokemon', [PokemonController::class, 'searchForm'])->name('pokemon.search.form');
Route::post('/pokemon', [PokemonController::class, 'searchByName'])->name('pokemon.search');
Route::get('/pokemon-list', [PokemonController::class, 'index'])->name('pokemon.index');