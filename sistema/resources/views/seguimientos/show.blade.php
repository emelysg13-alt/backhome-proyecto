@extends('layouts.backhome')

@section('contenido')

<div class="container">

<h2>{{ $reporte->titulo }}</h2>

<p>{{ $reporte->descripcion }}</p>

<p>
Estado:
{{ $reporte->estado_reporte }}
</p>

<a
href="/editar/{{ $reporte->id_seguimiento }}"
class="btn btn-warning">

Editar

</a>

</div>

@endsection