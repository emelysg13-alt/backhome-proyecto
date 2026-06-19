<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensajeSoporte;

class SoporteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['mensaje_cliente' => 'required|max:1000']);

        // Accedemos a la relación del usuario logueado
        $cliente = auth()->user()->cliente;

        if (!$cliente) {
            return back()->with('error', 'No tienes un perfil de cliente asociado.');
        }

        MensajeSoporte::create([
            'cliente_id' => $cliente->id_cliente,
            'mensaje_cliente' => $request->mensaje_cliente,
            'fecha_mensaje' => now(),
        ]);

        return back()->with('success', 'Mensaje enviado. ¡Gracias por contactarnos!');
    }
}