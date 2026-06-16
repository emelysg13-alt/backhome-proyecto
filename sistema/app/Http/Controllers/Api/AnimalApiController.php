<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalApiController extends Controller
{
    // GET /api/animales
    public function index()
    {
        return response()->json(Animal::all());
    }

    // GET /api/animales/{id}
    public function show($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json([
                'mensaje' => 'Animal no encontrado'
            ], 404);
        }

        return response()->json($animal);
    }

    // POST /api/animales
    public function store(Request $request)
    {
        $animal = Animal::create([
            'sexo' => $request->sexo,
            'color' => $request->color,
            'descripcion' => $request->descripcion
        ]);

        return response()->json([
            'mensaje' => 'Animal creado correctamente',
            'animal' => $animal
        ], 201);
    }

    // PUT /api/animales/{id}
    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json([
                'mensaje' => 'Animal no encontrado'
            ], 404);
        }

        $animal->update([
            'sexo' => $request->sexo,
            'color' => $request->color,
            'descripcion' => $request->descripcion
        ]);

        return response()->json([
            'mensaje' => 'Animal actualizado correctamente',
            'animal' => $animal
        ]);
    }

    // DELETE /api/animales/{id}
    public function destroy($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json([
                'mensaje' => 'Animal no encontrado'
            ], 404);
        }

        $animal->delete();

        return response()->json([
            'mensaje' => 'Animal eliminado correctamente'
        ]);
    }
}