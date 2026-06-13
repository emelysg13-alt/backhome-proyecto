<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - BackHome 🐾</title>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
</head>
<body>

    <nav class="navbar navbar-expand-xl custom-navbar sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/" style="font-family: 'Playwrite NZ Basic', cursive; font-weight: bold;">
                🐾 <span style="color: #ff9dc3;">BackHome</span>
            </a>
            <div class="ms-auto">
                <a href="/" class="btn-custom-link btn-logout text-decoration-none">CERRAR</a>
            </div>
        </div>
    </nav>

    <div class="container my-5 profile-container-main">
        <div class="row g-4 align-items-stretch">
            
        <div class="col-md-4">
                <div class="card shadow card-profile-left h-100 text-center p-4">
                    <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                        <span class="badge-role">
                            @if($user->administrador) ADMINISTRADOR @else CLIENTE @endif
                        </span>
                        <span class="status-active">
                            ● {{ strtoupper($user->estado ?? 'activo') }}
                        </span>
                    </div>

                    <div class="position-relative d-inline-block mx-auto my-3" style="width: 150px; height: 150px;">
                        
                        <div class="avatar-wrapper w-100 h-100 rounded-circle overflow-hidden border border-3" style="border-color: #ff9dc3; background-color: #f8f9fa;">
                            <img src="{{ $user->foto_perfil ? asset($user->foto_perfil) : 'https://i.pinimg.com/736x/e0/e2/49/e0e249dbb878081e427f627d91d29aeb.jpg' }}" 
                                 alt="Foto de perfil" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        
                        <label id="badge-camara" for="foto_perfil_input" class="change-photo-badge shadow-sm d-none position-absolute" 
                               style="bottom: 0; right: 0; background-color: #ff9dc3; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid white; z-index: 10;">
                            <i class="bi bi-camera-fill" style="font-size: 1.1rem;"></i>
                        </label>
                    </div>

                    <h3 class="profile-user-name mt-3">
                        {{ $user->primer_nombre }} {{ $user->primer_apellido }}
                    </h3>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow card-profile-right h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <span class="info-title-label">INFO</span>
                        <button type="button" id="btn-editar-perfil" class="btn p-0 edit-accent-label border-0 bg-transparent">
                            EDITAR <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>

                    <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <input type="file" id="foto_perfil_input" name="foto_perfil" class="d-none" accept="image/*" onchange="document.getElementById('profile-update-form').submit();">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Primer Nombre</label>
                                <input name="primer_nombre" type="text" class="form-control custom-input profile-editable-field" 
                                       value="{{ old('primer_nombre', $user->primer_nombre) }}" disabled required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Segundo Nombre</label>
                                <input name="segundo_nombre" type="text" class="form-control custom-input profile-editable-field" 
                                       value="{{ old('segundo_nombre', $user->segundo_nombre) }}" disabled />
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Primer Apellido</label>
                                <input name="primer_apellido" type="text" class="form-control custom-input profile-editable-field" 
                                       value="{{ old('primer_apellido', $user->primer_apellido) }}" disabled required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Segundo Apellido</label>
                                <input name="segundo_apellido" type="text" class="form-control custom-input profile-editable-field" 
                                       value="{{ old('segundo_apellido', $user->segundo_apellido) }}" disabled />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Número de Teléfono</label>
                            <input name="numero_tel" type="text" class="form-control custom-input profile-editable-field" 
                                   value="{{ old('numero_tel', $user->numero_tel) }}" disabled required />
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <input name="email" type="email" class="form-control custom-input profile-editable-field" 
                                   value="{{ old('email', $user->email) }}" disabled required />
                        </div>

                        <div id="password-update-box" class="d-none mb-4 animate-fade-in">
                            <div class="p-3 rounded-4" style="background-color: #fff9fc; border: 1px dashed #ff9dc3;">
                                <h6 class="fw-bold mb-3" style="color: #ff9dc3;">🔐 Actualizar Contraseña de Seguridad</h6>
                                
                                <div class="mb-2">
                                    <label class="form-label small fw-bold text-muted">Contraseña Actual</label>
                                    <input name="current_password" type="password" class="form-control custom-input form-control-sm profile-editable-field" autocomplete="current-password" disabled />
                                </div>

                                <div class="mb-2">
                                    <label class="form-label small fw-bold text-muted">Nueva Contraseña</label>
                                    <input name="password" type="password" class="form-control custom-input form-control-sm profile-editable-field" autocomplete="new-password" disabled />
                                </div>

                                <div class="mb-0">
                                    <label class="form-label small fw-bold text-muted">Confirmar Nueva Contraseña</label>
                                    <input name="password_confirmation" type="password" class="form-control custom-input form-control-sm profile-editable-field" autocomplete="new-password" disabled />
                                </div>
                            </div>
                        </div>

                        <div id="actions-form-box" class="d-none animate-fade-in">
                            <button type="button" class="btn btn-success px-4 fw-bold rounded-3 me-2" data-bs-toggle="modal" data-bs-target="#saveSuccessModal">
                                💾 GUARDAR
                            </button>
                            <button type="button" id="btn-cancelar-edicion" class="btn btn-secondary px-3 rounded-3">
                                Cancelar
                            </button>
                        </div>
                    </form>

                    <div class="text-end mt-4">
                        <button type="button" class="btn-trigger-delete" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            ELIMINAR CUENTA
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="divider-pink-line my-5"></div>

        <div class="row align-items-center mb-4">
            <div class="col-6">
                <h3 class="section-title-pink">SEGUIMIENTOS CREADOS</h3>
            </div>
            <div class="col-6 text-end">
                <a href="/crear" class="btn-create-plus-green text-decoration-none">CREAR +</a>
            </div>
        </div>

        <div class="row mb-4 justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="input-group search-bar-profile shadow-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador-mis-reportes" class="form-control" placeholder="Buscar entre mis reportes creados...">
                </div>
            </div>
        </div>

        <div class="row">
            @php
                $misReportes = \App\Models\Seguimiento::where('cliente_id', $user->cliente->id_cliente ?? 0)->get();
            @endphp

            @forelse($misReportes as $reporte)
            <div class="col-md-6 col-lg-4 mb-4 tarjeta-mis-reportes">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 20px; overflow:hidden;">
                    <img src="{{ $reporte->imagenPrincipal->ruta_imagen }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="Mascota">
                    <div class="card-body p-3">
                        <h5 class="fw-bold m-0">{{ strtoupper($reporte->titulo) }}</h5>
                        <p class="small text-muted m-0">📅 {{ date('d/m/Y', strtotime($reporte->fecha_publicacion)) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center p-4 bg-white rounded-4 border">
                <p class="text-muted m-0">No has creado ningún reporte todavía. 🐾</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="modal fade" id="saveSuccessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4 rounded-4 border-0">
                <div class="modal-body">
                    <div class="text-success display-3 mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-2" style="color: #333;">¡Cambios Guardados!</h3>
                    <p class="text-muted small mb-4">La información de tu perfil ha sido actualizada correctamente en el sistema.</p>
                    <button type="button" class="btn px-4 fw-bold text-white" style="background-color: #ff9dc3; border-radius:12px;" onclick="document.getElementById('profile-update-form').submit();">
                        Entendido 🐾
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <script>
        const btnEditar = document.getElementById('btn-editar-perfil');
        const btnCancelar = document.getElementById('btn-cancelar-edicion');
        const campoAcciones = document.getElementById('actions-form-box');
        const cajaPassword = document.getElementById('password-update-box');
        const badgeCamara = document.getElementById('badge-camara'); // Captura el elemento corregido
        const camposEditables = document.querySelectorAll('.profile-editable-field');

        btnEditar.addEventListener('click', () => {
            camposEditables.forEach(campo => campo.removeAttribute('disabled'));
            campoAcciones.classList.remove('d-none');
            cajaPassword.classList.remove('d-none');
            badgeCamara.classList.remove('d-none'); // MUESTRA la camarita al editar
            btnEditar.classList.add('d-none');
        });

        btnCancelar.addEventListener('click', () => {
            camposEditables.forEach(campo => {
                campo.setAttribute('disabled', 'true');
                if (campo.type === 'password') {
                    campo.value = '';
                }
            });
            campoAcciones.classList.add('d-none');
            cajaPassword.classList.add('d-none');
            badgeCamara.classList.add('d-none'); // OCULTA por completo la camarita al cancelar
            btnEditar.classList.remove('d-none');
        });

        document.getElementById('buscador-mis-reportes').addEventListener('keyup', function(){
            let query = this.value.toLowerCase();
            document.querySelectorAll('.tarjeta-mis-reportes').forEach(card => {
                card.style.display = card.innerText.toLowerCase().includes(query) ? 'block' : 'none';
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>