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
    <div class="container my-5">
    <h2 class="text-center mb-5" style="color: #ff9dc3;">Centro de Ayuda y Guía de Uso</h2>

    <div class="accordion" id="faqAyuda">
        
        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#cuenta">👤 Sobre tu cuenta y seguridad</button></h2>
            <div id="cuenta" class="accordion-collapse collapse show" data-bs-parent="#faqAyuda">
                <div class="accordion-body">
                    <ul>
                        <li><b>Recuperación:</b> Si olvidaste tu contraseña, usa el enlace "¿Olvidaste tu contraseña?" en la pantalla de inicio de sesión.</li>
                        <li><b>Estados de la cuenta:</b>
                            <ul>
                                <li><i>Activo:</i> Acceso total a la plataforma.</li>
                                <li><i>Suspendido:</i> Tu cuenta está inactiva temporalmente por incumplir normas menores.</li>
                                <li><i>Bloqueado:</i> Acceso restringido permanentemente por violaciones graves a los términos de uso.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#seguimientos">🐾 Uso correcto de Seguimientos</button></h2>
            <div id="seguimientos" class="accordion-collapse collapse" data-bs-parent="#faqAyuda">
                <div class="accordion-body">
                    <p>El objetivo de los seguimientos es ayudar a encontrar mascotas perdidas o reportar animales encontrados. Para mantener la comunidad sana:</p>
                    <ul>
                        <li><b>Prohibido crear seguimientos falsos:</b> La creación de datos ficticios será motivo de bloqueo inmediato.</li>
                        <li><b>Calidad:</b> Adjunta fotos claras y datos precisos de ubicación.</li>
                        <li><b>Responsabilidad:</b> Mantén el estado actualizado (ej: cambia a "Reunido" si la mascota ya volvió a casa).</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="card p-4 mt-5 border-0 shadow-lg text-center">
        <h4 style="color: #ff9dc3;">¿Aún tienes dudas?</h4>
        <p>Si tu problema no aparece aquí, nuestro equipo administrativo está listo para asistirte.</p>
        <a href="{{ route('contacto') }}" class="btn btn-primary btn-lg">Ir a formulario de contacto</a>
    </div>
</div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>