<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Cliente;
use App\Models\TipoDocumento;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
{
    $tiposDocumento = TipoDocumento::all();

    return view('auth.register', compact('tiposDocumento'));
}

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */



    public function store(Request $request): RedirectResponse
{
    $request->validate([

        't_documento_id' => 'required',

        'n_documento' => 'required|unique:personas',

        'primer_nombre' => 'required|max:100',
        'segundo_nombre' => 'nullable|max:100',

        'primer_apellido' => 'required|max:100',
        'segundo_apellido' => 'nullable|max:100',

        'numero_tel' => 'required|max:20',

        'email' => 'required|email|unique:personas',

        'password' => [
            'required',
            'confirmed',
            \Illuminate\Validation\Rules\Password::defaults()
        ],
        
    ]);

    $user = User::create([

        't_documento_id' => $request->t_documento_id,

        'n_documento' => $request->n_documento,

        'primer_nombre' => $request->primer_nombre,
        'segundo_nombre' => $request->segundo_nombre,

        'primer_apellido' => $request->primer_apellido,
        'segundo_apellido' => $request->segundo_apellido,

        'numero_tel' => $request->numero_tel,

        'email' => $request->email,

        'password' => Hash::make($request->password),
    ]);

    Cliente::create([
        'persona_id' => $user->id_persona,
        
    ]);

   Auth::login($user);

return redirect('/');
}

}   
