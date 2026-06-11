<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Back Home 🐾</title>

    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet"
href="{{ asset('css/backhome.css') }}">


</head>

<body>

    <header>
        <h1>🐾 Back Home</h1>
        <p>Encuentra mascotas perdidas o ayúdalas a volver a casa</p>
    </header>

    <nav class="navbar navbar-expand-xl custom-navbar sticky-top">
        <div class="container-fluid px-4">
            
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item">
                        <a href="/" class="nav-link">🏠 Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('descargar.reportes') }}" class="nav-link btn btn-danger">
                            📄 Descargar Reportes de Animales
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a href="/crear" class="nav-link btn btn-success">
                            🐾 Crear Seguimiento
                        </a>
                    </li>
                    @endauth
                </ul>

                <div class="navbar-nav align-items-center">
                    @guest
                        <span class="guest-text">
                            Debes iniciar sesión para crear un seguimiento.
                        </span>
                        <a href="{{ route('login') }}" class="nav-link">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="nav-link">
                            Registrarse
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('profile.edit') }}" class="nav-link">
                            👤 Mi Cuenta
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn-custom-link btn-logout">
                                Cerrar Sesión
                            </button>
                        </form>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>