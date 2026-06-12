@extends('layouts.backhome')

@section('contenido')

<div class="container">

<h2>Editar Reporte</h2>

<form
action="/actualizar/{{ $reporte->id_seguimiento }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Título</label>

<input
type="text"
name="titulo"
value="{{ $reporte->titulo }}"
class="form-control">

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea
name="descripcion"
class="form-control">{{ $reporte->descripcion }}</textarea>

</div>

<div class="mb-3">

<label>Estado</label>

<select
name="estado"
class="form-control">

<option value="perdido">Perdido</option>
<option value="encontrado">Encontrado</option>
<option value="reunido">Reunido</option>
<option value="cerrado">Cerrado</option>

</select>

</div>

<button
class="btn btn-success">

Guardar Cambios

</button>

</form>

</div>

@endsection