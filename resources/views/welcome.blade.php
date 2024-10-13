<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CINE-MARIANA</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand">Cine Mariana</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Cine Mariana</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Peliculas para hoy</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach($peliculas as $pelicula)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Imagen de la película -->
                                @if($pelicula->imagen)
                                    <img class="card-img-top" src="data:image/jpeg;base64,{{ base64_encode($pelicula->imagen) }}" alt="Imagen de {{ $pelicula->nombre }}" style="height: 300px; width: auto;">
                                @else
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Imagen no disponible" />
                                @endif
                                
                                <!-- Animación de la película -->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">{{ $pelicula->animacion }}</div>

                                <!-- Información de la película -->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Nombre de la película -->
                                        <h5 class="fw-bolder">{{ $pelicula->nombre }}</h5>

                                        <!-- Género de la película -->
                                        <p><strong>Género:</strong> {{ $pelicula->genero }}</p>
                                        
                                        <!-- Horarios de la película -->
                                        <p><strong>Horarios:</strong><br>
                                            @php
                                                $horarios = explode(',', $pelicula->horarios);
                                            @endphp
                                            @foreach($horarios as $horario)
                                                @php
                                                    $hora = date('g:i A', strtotime($horario));
                                                @endphp
                                                {{ $hora }}<br>
                                            @endforeach
                                        </p>

                                        <!-- Clasificación de la película -->
                                        <p><strong>Clasificación:</strong> <span class="text-primary fw-bold">{{ $pelicula->clasificacion }}</span></p>
                                    </div>
                                </div>

                                <!-- Footer con el enlace al tráiler -->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        @if($pelicula->trailer)
                                            @php
                                                preg_match('/[?&]v=([^&]+)/', $pelicula->trailer, $matches);
                                                $videoId = $matches[1] ?? null;
                                            @endphp
                                            @if($videoId)
                                                <a class="btn btn-outline-dark mt-auto" href="https://www.youtube.com/watch?v={{ $videoId }}" target="_blank">Ver Trailer</a>
                                            @else
                                                <p>Tráiler no disponible</p>
                                            @endif
                                        @else
                                            <p>Tráiler no disponible</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Cine Mariana 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
