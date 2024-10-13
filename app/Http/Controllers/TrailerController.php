<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrailerController extends Controller
{
    public function show($id)
    {
        // Aquí puedes realizar la lógica necesaria para mostrar el tráiler.
        return view('trailer', ['videoId' => $id]); // Pasa el video ID a la vista
    }
}
