<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Persona::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        Persona::create([
            't_documento_id' => $request->t_documento_id,
            'n_documento' => $request->n_documento,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'email' => $request->email,
            'numero_tel' => $request->numero_tel,
            'password' => bcrypt($request->password),
            'estado' => $request->estado
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente');
    }

    public function show($id)
    {
        $usuario = Persona::findOrFail($id);

        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Persona::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Persona::findOrFail($id);

        $usuario->update([
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'email' => $request->email,
            'numero_tel' => $request->numero_tel,
            'estado' => $request->estado,
        ]);

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        $usuario = Persona::findOrFail($id);

        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}