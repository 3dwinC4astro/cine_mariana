@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="border p-4" style="max-width: 700px; margin: auto;">
        <h2 class="text-center">Agregar Película</h2>
        <form method="POST" action="{{ route('peliculas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre de la Película:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="horarios">Selecciona Horarios:</label>
                <input type="time" class="form-control" id="horario">
                <button type="button" class="btn btn-secondary mt-2" id="addHorario">Agregar Horario</button>
                <div id="horariosList" class="mt-2"></div>
                <input type="hidden" name="horarios" id="horariosInput"> <!-- Input oculto para almacenar los horarios -->
            </div>

            <div class="form-group">
                <label for="clasificacion">Clasificación:</label>
                <input type="text" class="form-control" id="clasificacion" name="clasificacion">
            </div>

            <div class="form-group">
                <label for="genero">Género:</label>
                <select class="form-control" id="genero" name="genero" required>
                    <option value="">Selecciona un género</option>
                    <option value="Acción">Acción</option>
                    <option value="Romance">Romance</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Drama">Drama</option>
                    <option value="Ciencia ficción">Ciencia Ficción</option>
                    <option value="Terror">Terror</option>
                    <!-- Agrega más géneros según sea necesario -->
                </select>
            </div>

            <div class="form-group">
                <label for="animacion">Tipo de Animación:</label>
                <select class="form-control" id="animacion" name="animacion" required>
                    <option value="">Selecciona el tipo de animación</option>
                    <option value="2D">2D</option>
                    <option value="3D">3D</option>
                </select>
            </div>

            <div class="form-group">
                <label for="trailer">Enlace del Trailer:</label>
                <input type="url" class="form-control" id="trailer" name="trailer">
            </div>

            <div class="form-group">
                <label for="imagen">Cargar Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)" required>
                <img id="imagePreview" src="#" alt="Vista previa de la imagen" class="mt-3" style="display: none; max-width: 150px; height: auto;">
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">Guardar Película</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const horarios = []; // Array para almacenar los horarios

        // Función para mostrar la imagen seleccionada
        window.previewImage = function(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.style.display = 'block';
        }

        // Función para agregar horarios
        document.getElementById('addHorario').addEventListener('click', function() {
            const horarioInput = document.getElementById('horario');
            const horariosList = document.getElementById('horariosList');

            if (horarioInput.value) {
                horarios.push(horarioInput.value); // Agrega el horario al array
                const horarioDiv = document.createElement('div');
                horarioDiv.className = 'd-flex justify-content-between align-items-center mt-1';
                horarioDiv.innerHTML = `
                    <span>${horarioInput.value}</span>
                    <button type="button" class="btn btn-danger btn-sm removeHorario">Eliminar</button>
                `;
                horariosList.appendChild(horarioDiv);
                horarioInput.value = ''; // Limpia el campo de entrada

                // Agregar evento para eliminar el horario
                horarioDiv.querySelector('.removeHorario').addEventListener('click', function() {
                    const index = horarios.indexOf(horarioDiv.firstChild.textContent);
                    if (index > -1) {
                        horarios.splice(index, 1); // Elimina el horario del array
                    }
                    horariosList.removeChild(horarioDiv);
                    updateHorariosInput(); // Actualiza el input oculto
                });

                updateHorariosInput(); // Actualiza el input oculto
            } else {
                alert('Por favor, selecciona un horario antes de agregarlo.'); // Mensaje de alerta si no hay horario
            }
        });

        // Función para actualizar el input oculto con los horarios
        function updateHorariosInput() {
            document.getElementById('horariosInput').value = horarios.join(','); // Une los horarios en una cadena
        }
    });
</script>
@endsection
