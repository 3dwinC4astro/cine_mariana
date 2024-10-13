<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .error-code {
            font-size: 72px;
            font-weight: 700;
            color: #636b6f;
        }
        .message {
            font-size: 24px;
            margin-bottom: 20px;
            color: #636b6f;
        }
        .btn-home {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="card-header bg-dark text-white text-center">
                  
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid my-3" style="max-width: 200px;">
                </div>
        <div class="error-code">404</div>
        <div class="message">Lo sentimos, la página que buscas no existe.</div>
        <a href="{{ url('/') }}" class="btn-home">Volver al Inicio</a>
    </div>
</body>
</html>
