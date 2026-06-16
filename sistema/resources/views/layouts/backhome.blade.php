<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Home 🐾</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/backhome.css') }}">
    <script src="{{ asset('js/backhome.js') }}" defer></script>
</head>

<body>

    <div id="loader-wrapper">
        <img src="{{ asset('gif/cargando.gif') }}" alt="Cargando..." class="loader-cat">
    </div>

<nav class="navbar navbar-expand-xl custom-navbar sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="/" style="font-family: 'Playwrite NZ Basic', cursive; font-weight: bold;">
        
            <img src="{{ asset('img/Logo.png') }}" class="logo-backhome" alt="Logo" /> 
            <span style="color: #ff9dc3;">BackHome</span>
        </a>
            
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto align-items-center">
    
                    @auth
                    <li class="nav-item">
                        <a href="/crear" class="nav-link btn-success-custom">
                            🐾 Crear Seguimiento
                        </a>
                    </li>
                    @endauth
                </ul>

                <div class="navbar-nav align-items-center">
                    @guest
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

    <div class="container mt-4 mb-2" style="max-width: 1140px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm py-3 px-4 text-white d-flex align-items-center justify-content-between" 
                 role="alert" 
                 style="background-color: #2ec4b6; border-radius: 50px;">
                <div>
                    ✨ <strong>¡Logrado!</strong> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm py-3 px-4 text-white" 
                 role="alert" 
                 style="background-color: #e63946; border-radius: 20px;">
                <strong class="d-block mb-1">⚠️ Ups, verifica lo siguiente:</strong>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container hero-container text-start">
            <div class="hero-content-box">
                <h1 class="hero-title">BACKHOME</h1>
                <p class="hero-description">
                    Encuentra a tu mejor amigo para compartir tu mejor tiempo. Ayuda a reunir a las mascotas perdidas con sus familias.
                </p>
                <div class="hero-buttons">
                    <a href="/contacto" class="btn-hero-contact">
                        Contacto 🐾
                    </a>
                </div>
            </div>
        </div>
    </section>


    

    <div class="container mt-solapado">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>