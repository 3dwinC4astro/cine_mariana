<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    // Mostrar todas las películas
    public function index()
    {
        // Obtiene todas las películas
        $peliculas = Pelicula::all();

        // Retorna la vista con las películas
        return view('peliculas.index', compact('peliculas'));
        
    }

    // Formulario para crear una nueva película
    public function create()
    {
        return view('peliculas.create');
    }

    // Almacenar una nueva película
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'horarios' => 'required|string',
            'clasificacion' => 'nullable|string|max:50',
            'trailer' => 'nullable|url',
            'genero' => 'required|string',
            'animacion' => 'required|string', // Asegúrate de que esto coincida con el tipo esperado
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            $pelicula = new Pelicula();
            $pelicula->nombre = $request->nombre;
            $pelicula->horarios = $request->horarios;
            $pelicula->clasificacion = $request->clasificacion;
            $pelicula->trailer = $request->trailer;
            $pelicula->genero = $request->genero;
            $pelicula->animacion = $request->animacion;
    
            if ($request->hasFile('imagen')) {
                $pelicula->imagen = file_get_contents($request->file('imagen'));
            }
    
            $pelicula->save();
    
            return redirect()->route('peliculas.index')->with('success', 'Película agregada exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    // Formulario para editar una película
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', compact('pelicula'));
    }

    // Actualizar una película
    public function update(Request $request, Pelicula $pelicula)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'horarios' => 'nullable|string',
        'clasificacion' => 'nullable|string|max:50',
        'genero' => 'required|string',
        'animacion' => 'required|string',
        'trailer' => 'nullable|url',
        'imagen' => 'nullable|image|max:2048', // Ajusta el tamaño según sea necesario
    ]);

    // Actualizar los atributos
    $pelicula->nombre = $request->nombre;
    $pelicula->horarios = $request->horarios;
    $pelicula->clasificacion = $request->clasificacion;
    $pelicula->genero = $request->genero;
    $pelicula->animacion = $request->animacion;
    $pelicula->trailer = $request->trailer;

    // Manejar la imagen
    if ($request->hasFile('imagen')) {
        $pelicula->imagen = file_get_contents($request->file('imagen')->getRealPath());
    }

    // Guardar los cambios
    $pelicula->save();

    return redirect()->route('peliculas.index')->with('success', 'Película actualizada con éxito.');
}


    // Eliminar una película
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return redirect()->route('peliculas.index')->with('success', 'Película eliminada correctamente');
    }

    // Mostrar una película específica (si es necesario)
    public function show($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        try {
            return response()->json($pelicula);
        } catch (\Illuminate\Database\Eloquent\JsonEncodingException $e) {
            // Muestra los datos que causan el error
            return response()->json([
                'error' => $e->getMessage(),
                'data' => $pelicula->toArray(), // Muestra los datos en forma de array
            ], 500);
        }
    }
}
