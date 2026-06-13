<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido - BackHome 🐾</title>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Playwrite NZ Basic', cursive;
            background: linear-gradient(180deg, #ffd9ec, #fff4cc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            border-radius: 24px !important;
            border: none !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    @if(auth()->check() && strtolower(auth()->user()->estado) === 'suspendido')
    <div class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div class="text-warning display-1 mb-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-2" style="color: #d97706;">¡ALTO! Cuenta Suspendida</h2>
                    <p class="text-muted mb-4">Lo sentimos, tu cuenta se encuentra temporalmente suspendida por los administradores de BackHome.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="/contacto" class="btn py-2 fw-bold text-white" style="background-color: #ff9dc3; border-radius:12px;">
                            <i class="bi bi-envelope-fill"></i> Contactar al Administrador
                        </a>
                        <a href="#" class="btn btn-light py-2 fw-bold text-muted border" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Regresar al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->check() && strtolower(auth()->user()->estado) === 'bloqueado')
    <div class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div class="text-danger display-1 mb-3">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-2" style="color: #dc2626;">Cuenta Bloqueada</h2>
                    <p class="text-muted mb-4">Esta cuenta ha sido bloqueada permanentemente y no puede acceder al sistema.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="/register" class="btn py-2 fw-bold text-white" style="background-color: #198754; border-radius:12px;" 
                           onclick="event.preventDefault(); document.getElementById('logout-to-register-form').submit();">
                            <i class="bi bi-person-plus-fill"></i> Crear Nueva Cuenta
                        </a>
                        <a href="#" class="btn btn-light py-2 fw-bold text-muted border" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <form id="logout-to-register-form" action="{{ route('logout') }}?redirect_to=register" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CORRECCIÓN: 'bootstrap' con minúscula inicial para que inicialice el modal sin romperse
        const modalElement = document.getElementById('statusModal');
        if (modalElement) {
            const myModal = new bootstrap.Modal(modalElement);
            myModal.show();
        }
    </script>
</body>
</html>