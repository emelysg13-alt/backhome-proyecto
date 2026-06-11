
<section class="profile-form-container">
    <header class="mb-4">
        <h3 class="section-title">
            🐾 {{ __('Profile Information') }}
        </h3>
        <p class="text-muted small">
            {{ __("Update your account's profile information, contact details, and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="primer_nombre" class="form-label">Primer Nombre</label>
                <input id="primer_nombre" name="primer_nombre" type="text" class="form-control custom-input" 
                       value="{{ old('primer_nombre', $user->primer_nombre) }}" required autofocus autocomplete="given-name" />
                <x-input-error class="mt-1 small text-danger" :messages="$errors->get('primer_nombre')" />
            </div>

            <div class="col-md-6">
                <label for="segundo_nombre" class="form-label">Segundo Nombre (Opcional)</label>
                <input id="segundo_nombre" name="segundo_nombre" type="text" class="form-control custom-input" 
                       value="{{ old('segundo_nombre', $user->segundo_nombre) }}" autocomplete="additional-name" />
                <x-input-error class="mt-1 small text-danger" :messages="$errors->get('segundo_nombre')" />
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="primer_apellido" class="form-label">Primer Apellido</label>
                <input id="primer_apellido" name="primer_apellido" type="text" class="form-control custom-input" 
                       value="{{ old('primer_apellido', $user->primer_apellido) }}" required autocomplete="family-name" />
                <x-input-error class="mt-1 small text-danger" :messages="$errors->get('primer_apellido')" />
            </div>

            <div class="col-md-6">
                <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                <input id="segundo_apellido" name="segundo_apellido" type="text" class="form-control custom-input" 
                       value="{{ old('segundo_apellido', $user->segundo_apellido) }}" autocomplete="family-name" />
                <x-input-error class="mt-1 small text-danger" :messages="$errors->get('segundo_apellido')" />
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="numero_tel" class="form-label">Número de Teléfono</label>
                <input id="numero_tel" name="numero_tel" type="text" class="form-control custom-input" 
                       value="{{ old('numero_tel', $user->numero_tel) }}" placeholder="Ej: 3001234567" autocomplete="tel" />
                <x-input-error class="mt-1 small text-danger" :messages="$errors->get('numero_tel')" />
            </div>

            <div class="col-md-6">
                <label for="direccion_cliente" class="form-label">Dirección de Residencia</label>
                <input id="direccion_cliente" name="direccion_cliente" type="text" class="form-control custom-input" 
                       value="{{ old('direccion_cliente', $user->cliente->direccion_cliente ?? '') }}" placeholder="Calle, Carrera, Barrio..." />
                <x-input-error class="mt-1 small text-danger" :messages="$errors->get('direccion_cliente')" />
            </div>
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input id="email" name="email" type="email" class="form-control custom-input" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-1 small text-danger" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-2 bg-light rounded border">
                    <p class="text-sm m-0 text-muted">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link btn-sm p-0 m-0 align-baseline text-decoration-underline text-secondary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium small text-success m-0">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn-custom-save">
                💾 {{ __('Save') }}
            </button>

            <a href="/" class="btn-custom-back">
                ⬅️ Volver al Inicio
            </a>

            

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="small text-success m-0 fw-bold animate__animated animate__fadeIn"
                >✨ {{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>