<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Rellenar con los campos de texto validados del formulario
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 🐾 SOLUCCIÓN: Capturar el archivo directamente desde el request general, no desde el validated()
        if ($request->hasFile('foto_perfil')) {
            
            // 1. Obtenemos el archivo binario de la imagen
            $imagen = $request->file('foto_perfil');
            
            // 2. Creamos un nombre único e irrepetible
            $nombreImagen = 'avatar_' . $user->id_persona . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            
            // 3. Movemos físicamente la foto a la carpeta: public/descargas/fotosperfil/
            // (Usamos esta ruta para que coincida con lo que guardas en base de datos)
            $imagen->move(public_path('descargas/fotosperfil'), $nombreImagen);
            
            // 4. Si el usuario ya tenía una foto previa, la borramos del servidor para no acumular basura
            if ($user->foto_perfil && file_exists(public_path($user->foto_perfil))) {
                @unlink(public_path($user->foto_perfil));
            }

            // 5. Guardamos exactamente la misma ruta estructural en la Base de Datos
            $user->foto_perfil = 'descargas/fotosperfil/' . $nombreImagen;
        }

        // Guardamos de manera segura en la tabla 'personas'
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
