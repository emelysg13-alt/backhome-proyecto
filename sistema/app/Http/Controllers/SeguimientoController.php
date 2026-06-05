<?php

namespace App\Http\Controllers;

use App\Models\ImagenSeguimiento;
use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Seguimiento::query();

        if($request->estado)
        {
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
            ->orderBy('fecha_publicacion','desc')
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
        $seguimiento = Seguimiento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado_reporte' => $request->estado,
            'animal_id' => 1,
            'lugar_id' => 1,
            'cliente_id' => 1
        ]);


        // Guardar imagen

    if ($request->hasFile('imagen')) {

            $ruta = $request->file('imagen')
                             ->store('seguimientos', 'public');

            \App\Models\ImagenSeguimiento::create([
                'seguimiento_id' => $seguimiento->id_seguimiento,
                'ruta_imagen' => $ruta,
                'imagen_principal' => true
            ]);
        }

        return redirect('/');
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




$seguimientos = Seguimiento::orderBy(
    'fecha_publicacion',
    'desc'
)->get();