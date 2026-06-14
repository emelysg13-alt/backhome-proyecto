<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalDomestico;
use App\Models\AnimalExotico; 
use App\Models\Cliente;
use App\Models\ImagenSeguimiento;
use App\Models\Localidad; 
use App\Models\Lugar;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Seguimiento::query();

        if ($request->estado) {
            $query->where(
                'estado_reporte',
                $request->estado
            );
        }

        $reportes = $query
            ->with([
                'animal.domestico',
                'animal.exotico',
                'lugar.localidad'
            ])
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view(
            'seguimientos.index',
            compact('reportes')
        );
    }

    public function create()
    {
        
        $localidades = Localidad::all();

      
        return view(
            'seguimientos.create', 
            compact('localidades')
        );
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'required',
            'tipo_animal' => 'required|in:domestico,exotico',
            'especie' => 'required',
            'raza' => 'nullable|max:100',
            'sexo' => 'required',
            'color' => 'required',
            'direccion' => 'required',
            'localidad_id' => 'required|exists:localidades,id_localidad'
        ]);

        DB::transaction(function () use ($request) {

            $animal = Animal::create([
                'sexo' => $request->sexo,
                'color' => $request->color,
                'descripcion' => $request->descripcion
            ]);

            if ($request->tipo_animal === 'domestico') {
                AnimalDomestico::create([
                    'animal_id' => $animal->id_animal,
                    'especie' => $request->especie,
                    'raza' => $request->raza ?? 'Sin especificar'
                ]);
            } else {
                AnimalExotico::create([
                    'animal_id' => $animal->id_animal,
                    'especie' => $request->especie
                ]);
            }

            $lugar = Lugar::create([
                'direccion' => $request->direccion,
                'localidad_id' => $request->localidad_id
            ]);

            $cliente = Cliente::where(
                'persona_id',
                Auth::id()
            )->first();

            $seguimiento = Seguimiento::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'estado_reporte' => $request->estado,
                'animal_id' => $animal->id_animal,
                'lugar_id' => $lugar->id_lugar,
                'cliente_id' => $cliente->id_cliente
            ]);

            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $index => $imagen) {
                    $ruta = $imagen->store(
                        'seguimientos',
                        'public'
                    );

                    ImagenSeguimiento::create([
                        'seguimiento_id' => $seguimiento->id_seguimiento,
                        'ruta_imagen' => $ruta,
                        'imagen_principal' => ($index == 0)
                    ]);
                }
            }
        });

        return redirect('/')
            ->with(
                'success',
                'Reporte creado correctamente'
            );
    }

  
    public function show($id)
    {
    
        $reporte = Seguimiento::with([
            'animal.domestico',
            'animal.exotico',
            'lugar.localidad',
            'historial',
            'cliente'
        ])->findOrFail($id);

        return view(
            'seguimientos.show',
            compact('reporte')
        );
    }
  public function edit($id)
    {
      
        $reporte = Seguimiento::with('lugar')->findOrFail($id);

        $localidades = \App\Models\Localidad::all();


        return view(
            'seguimientos.edit',
            compact('reporte', 'localidades')
        );
    }

public function update(Request $request, $id)
{
   
    $request->validate([
        'titulo' => 'required|max:150',
        'estado' => 'required' 
    ]);

    $reporte = Seguimiento::findOrFail($id);

    $reporte->update([
        'titulo' => $request->titulo,
        'estado_reporte' => $request->estado
    ]);

    return redirect('/')->with('success', 'Reporte actualizado correctamente. 🐾');
}

public function destroy($id)
{

    $reporte = Seguimiento::findOrFail($id);
    $reporte->delete();


    return redirect('/')->with('success', 'El reporte ha sido eliminado correctamente.');
}

    public function historial($id)
    {
        $reporte = Seguimiento::with([
            'historial',
            'animal.domestico',
            'animal.exotico',
            'lugar.localidad'
        ])->findOrFail($id);

        return view(
            'seguimientos.historial',
            compact('reporte')
        );
    }

    
}