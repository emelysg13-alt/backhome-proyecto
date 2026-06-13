<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarEstadoUsuario
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Si el usuario está logueado, revisamos su estado actual
        if (Auth::check()) {
            
            // Convertimos a minúsculas por si en la base de datos hay variaciones
            $estado = strtolower(Auth::user()->estado ?? 'activo');

            // 2. Si el usuario está suspendido o bloqueado...
            if (in_array($estado, ['suspendido', 'bloqueado'])) {
                
                // 🌟 EXCEPCIÓN CRUCIAL: Si ya está en la ruta de la alerta, o está cerrando sesión, déjalo pasar
                if ($request->is('cuenta-restringida') || $request->is('logout') || $request->is('logout*')) {
                    return $next($request);
                }

                // Si intenta ir a cualquier otra página (perfil, inicio, crear), desvíalo al modal
                return redirect('/cuenta-restringida');
            }
        }

        return $next($request);
    }
}