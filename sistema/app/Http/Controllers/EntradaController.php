<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

use App\Http\Requests\EntradaRequest;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return $request->query();
        //return $request->path();
        return $request->input('titulo', 'No se proporcionó un título');
            

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entrada.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntradaRequest $request)
    {

     $entrada = new Entrada();
        $entrada->titulo = $request->input('titulo'); 
        $entrada->tag = $request->input('tag');  
        $entrada->contenido = $request->input('contenido');
        $entrada->imagen="";
        $entrada->user_id = 1;
        $entrada->save();

        return redirect()->route('entrada.create')->with('success', 'Entrada creada exitosamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        return "Show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
}
