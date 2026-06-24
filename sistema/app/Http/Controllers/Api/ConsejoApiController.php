<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consejo;
use Illuminate\Http\Request;

class ConsejoApiController extends Controller
{
    public function index()
    {
        return response()->json(Consejo::all());
    }

    public function store(Request $request)
    {
        return response()->json(
            Consejo::create($request->all()),
            201
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Consejo::findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $consejo = Consejo::findOrFail($id);

        $consejo->update($request->all());

        return response()->json($consejo);
    }

    public function destroy(string $id)
    {
        Consejo::destroy($id);

        return response()->json([
            'mensaje'=>'Consejo eliminado'
        ]);
    }
}