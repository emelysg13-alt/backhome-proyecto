@extends('layouts.backhome')

@section('contenido')

<div class="container">

<div class="card shadow">

<div class="card-header text-center">

<h2>
📜 Historial del Reporte
</h2>

</div>

<div class="card-body">

<h3 class="mb-3">

{{ strtoupper($reporte->titulo) }}

</h3>

<hr>

<p>

<strong>📅 Fecha de publicación:</strong>

{{ date('d/m/Y', strtotime($reporte->fecha_publicacion)) }}

</p>

<p>

<strong>📍 Estado actual:</strong>

{{ ucfirst($reporte->estado_reporte) }}

</p>

<p>

<strong>📌 Dirección:</strong>

{{ $reporte->lugar->direccion ?? 'No registrada' }}

</p>

<p>

<strong>🏙️ Localidad:</strong>

{{ $reporte->lugar->localidad->n_localidad ?? 'No registrada' }}

</p>

<p>

<strong>📝 Descripción:</strong>

</p>

<div class="alert alert-light">

{{ $reporte->descripcion }}

</div>

<hr>

<h4 class="mb-3">

🔄 Cambios de Estado

</h4>

@if($reporte->historial->count())

@foreach($reporte->historial as $item)

<div class="card mb-2">

<div class="card-body">

<p>

Estado anterior:

<strong>

{{ $item->estado_anterior }}

</strong>

</p>

<p>

Estado nuevo:

<strong>

{{ $item->estado_nuevo }}

</strong>

</p>

<p>

Fecha:

<strong>

{{ $item->fecha_cambio }}

</strong>

</p>

</div>

</div>

@endforeach

@else

<div class="alert alert-info">

No existen cambios registrados para este reporte.

</div>

@endif

<div class="text-center mt-4">

<a
href="/"
class="btn btn-secondary">

⬅ Volver a Reportes

</a>

</div>

</div>

</div>

</div>

@endsection