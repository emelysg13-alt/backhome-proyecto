<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Cliente;
use App\Models\Seguimiento;

class ProfileController extends Controller
{
    /**
     * Vista de mi propio perfil (Usuario Autenticado)
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $esMiPerfil = true; 

        return view('profile.edit', compact('user', 'esMiPerfil'));
    }

    /**
     * Vista dinámica para ver cualquier perfil usando la misma vista
     */
    public function verPerfil($id_persona)
    {
        // Evaluamos si el perfil consultado le pertenece al usuario logueado
        $esMiPerfil = (int) $id_persona === (int) Auth::id();
        
        // Buscamos los datos de la persona/usuario solicitado
        $user = \App\Models\User::findOrFail($id_persona);

        return view('profile.edit', compact('user', 'esMiPerfil'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = 'avatar_' . $user->id_persona . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('descargas/fotosperfil'), $nombreImagen);
            
            if ($user->foto_perfil && file_exists(public_path($user->foto_perfil))) {
                @unlink(public_path($user->foto_perfil));
            }

            $user->foto_perfil = 'descargas/fotosperfil/' . $nombreImagen;
        }

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

    public function miPerfil()
    {
        $cliente = Cliente::where('persona_id', Auth::id())->first();

        if (!$cliente) {
            return redirect('/')->with('error', 'No se encontró tu perfil de cliente.');
        }

        $reportes = Seguimiento::where('cliente_id', $cliente->id_cliente)
            ->with(['animal.domestico', 'lugar.localidad', 'cliente'])
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('perfil.index', compact('reportes'));
    }
}