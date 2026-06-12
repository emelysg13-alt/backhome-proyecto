<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalDomestico;
use App\Models\Cliente;
use App\Models\ImagenSeguimiento;
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
        return view(
            'seguimientos.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'required',
            'especie' => 'required',
            'raza' => 'required',
            'sexo' => 'required',
            'color' => 'required',
            'direccion' => 'required'
        ]);

        DB::transaction(function () use ($request) {

            $animal = Animal::create([
                'sexo' => $request->sexo,
                'color' => $request->color,
                'descripcion' => $request->descripcion
            ]);

            AnimalDomestico::create([
                'animal_id' => $animal->id_animal,
                'especie' => $request->especie,
                'raza' => $request->raza
            ]);

            $lugar = Lugar::create([
                'direccion' => $request->direccion,
                'localidad_id' => 1
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
            'historial'
        ])->findOrFail($id);

        return view(
            'seguimientos.show',
            compact('reporte')
        );
    }

    public function edit($id)
    {
        $reporte = Seguimiento::findOrFail($id);

        return view(
            'seguimientos.edit',
            compact('reporte')
        );
    }

    public function update(Request $request, $id)
    {
        $reporte = Seguimiento::findOrFail($id);

        $reporte->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado_reporte' => $request->estado
        ]);

        return redirect('/')
            ->with(
                'success',
                'Reporte actualizado correctamente'
            );
    }

    public function destroy($id)
    {
        Seguimiento::findOrFail($id)->delete();

        return redirect('/');
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