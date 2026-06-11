
<link rel="stylesheet"
href="{{ asset('css/perfil.css') }}">


<div class="container my-5">
    
    <!-- Encabezado de la Sección -->
    <div class="row mb-4">
        <div class="col-12 text-center text-md-start">
            <h2 class="profile-main-title">
                👤 {{ __('Profile') }}
            </h2>
            <p class="text-muted small">Administra la información de tu cuenta, seguridad y accesos.</p>
        </div>
    </div>

    <!-- Bloques de Formularios de Laravel organizados con Bootstrap -->
    <div class="row g-4 justify-content-center">
        <div class="col-lg-10 col-xl-8">
            
            <!-- Bloque 1: Información del Perfil -->
            <div class="card p-4 p-sm-5 profile-custom-card mb-4">
                <div class="profile-form-container">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Bloque 2: Actualizar Contraseña -->
            <div class="card p-4 p-sm-5 profile-custom-card mb-4">
                <div class="profile-form-container">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Bloque 3: Eliminar Cuenta -->
            <div class="card p-4 p-sm-5 profile-custom-card border-danger-subtle">
                <div class="profile-form-container">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>