<section class="profile-form-container">
    <header class="mb-4">
        <h3 class="section-title text-danger">
            ⚠️ {{ __('Delete Account') }}
        </h3>
        <p class="text-muted small">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="danger-zone-box p-4 rounded-4 mt-3">
        <h5 class="fw-bold text-danger mb-3">
            ¿Seguro que quieres borrar tu cuenta? 🐾
        </h5>
        
        <p class="text-muted small mb-4">
            {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="m-0">
            @csrf
            @method('delete')

            <div class="mb-4 max-width-input">
                <label for="password_delete" class="form-label small fw-bold">Escribe tu contraseña actual:</label>
                <input 
                    id="password_delete" 
                    name="password" 
                    type="password" 
                    class="form-control custom-input @error('password', 'userDeletion') is-invalid @enderror" 
                    placeholder="{{ __('Password') }}"
                    required
                />
                
                @error('password', 'userDeletion')
                    <div class="text-danger mt-1 small fw-bold">
                        ❌ {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex flex-wrap gap-3 align-items-center">
                <a href="/" class="btn-custom-back m-0">
                    {{ __('Cancel') }}
                </a>

                <button type="submit" class="btn-custom-delete">
                    💥 ¡Sí, Eliminar Cuenta!
                </button>
            </div>
        </form>
    </div>
</section>