<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;


class HomeController extends Controller
{

    public function index()
{
    $peliculas = Pelicula::all(); // Obtén todas las películas
    return view('welcome', compact('peliculas')); // Envía la variable a la vista
}
}
