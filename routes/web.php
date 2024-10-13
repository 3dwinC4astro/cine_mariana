<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrailerController;

// Ruta principal que redirige al controlador HomeController para mostrar la vista welcome
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Rutas de autenticación (login, registro, etc.)
Auth::routes();



Route::get('/trailer/{id}', [TrailerController::class, 'show'])->name('trailer');


// Ruta del panel de administración que redirige al índice de películas
Route::get('/admin', function () {
    return redirect()->route('peliculas.index'); // Redirigir al índice de películas
})->name('home');

// Agrupar las rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    Route::resource('peliculas', PeliculaController::class);
    Route::get('admin/peliculas/{id}', [PeliculaController::class, 'show']);
    Route::post('/peliculas/store', [PeliculaController::class, 'store'])->name('peliculas.store');
});
