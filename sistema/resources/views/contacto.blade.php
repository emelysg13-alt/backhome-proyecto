<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Home 🐾 - Soporte</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/backhome.css') }}">
    <script src="{{ asset('js/backhome.js') }}" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">

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

   <section class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="mb-3 text-primary">Contacto de Soporte</h3>
                    <form action="{{ route('soporte.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tu mensaje</label>
                            <textarea name="mensaje_cliente" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 ps-md-5">
            <h2 class="text-secondary">¿Cómo usar BackHome?</h2>
            <p>Aquí puedes reportar incidencias sobre tus mascotas o solicitar ayuda con la plataforma.</p>
            <ul class="list-unstyled">
                <li><i class="bi bi-check-circle-fill text-success"></i> Sé específico en tu reporte.</li>
                <li><i class="bi bi-check-circle-fill text-success"></i> Los administradores responderán pronto.</li>
                <li><i class="bi bi-check-circle-fill text-success"></i> Revisa tus notificaciones.</li>
            </ul>
        </div>
    </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>