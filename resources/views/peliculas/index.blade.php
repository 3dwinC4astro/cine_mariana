@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Películas</h1>
    <a href="{{ route('peliculas.create') }}" class="btn btn-primary mb-3">Agregar Nueva Película</a>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Horarios</th>
                    <th>Clasificación</th>
                    <th>Género</th>
                    <th>Animación</th>
                    <th>Trailer</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peliculas as $pelicula)
                    <tr>
                        <td style="font-size: 1.3rem; font-weight: bold; text-align: center; vertical-align: middle; text-align: center;">{{ $pelicula->nombre }}</td>
                        <td style="font-size: 1rem; font-weight: bold; vertical-align: middle; text-align: center;">
                            @php
                                $horarios = explode(',', $pelicula->horarios);
                            @endphp
                            @if(!empty($horarios))
                                @foreach($horarios as $horario)
                                    @php
                                        $hora = date('g:i A', strtotime($horario));
                                    @endphp
                                    {{ $hora }}<br>
                                @endforeach
                            @else
                                <span style="color: red;">Sin horarios</span>
                            @endif
                        </td>
                        <td style="color: blue; font-size: 1.5rem; font-weight: bold; text-align: center; vertical-align: middle; text-align: center;">{{ $pelicula->clasificacion }}</td>
                        <td style="font-size: 1rem; font-weight: bold; text-align: center; vertical-align: middle; text-align: center;">{{ $pelicula->genero }}</td>
                        <td style="font-size: 1rem; font-weight: bold; text-align: center; vertical-align: middle; text-align: center;">
                            <span style=" vertical-align: middle; text-align: center; background-color: black; color: white; padding: 5px; border-radius: 3px; display: inline-block; text-align: center;">
                                {{ $pelicula->animacion }}
                            </span>
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            @if($pelicula->trailer)
                                @php
                                    preg_match('/[?&]v=([^&]+)/', $pelicula->trailer, $matches);
                                    $videoId = $matches[1] ?? null;
                                @endphp
                                @if($videoId)
                                    <iframe width="200" height="110" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                @else
                                    <p>No disponible</p>
                                @endif
                            @else
                                <p>No disponible</p>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($pelicula->imagen)
                                <img src="data:image/jpeg;base64,{{ base64_encode($pelicula->imagen) }}" alt="Imagen de {{ $pelicula->nombre }}" style="width: 80px; height: auto;">
                            @else
                                <p>No disponible</p>
                            @endif
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            <a href="{{ route('peliculas.edit', $pelicula) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('peliculas.destroy', $pelicula) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
