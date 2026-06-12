@extends('layouts.backhome')

@section('contenido')

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow-lg border-0">

<div class="card-header text-center bg-warning">

<h2 class="m-0">
🐾 Crear Reporte de Mascota
</h2>

</div>

<div class="card-body p-4">

<form
action="/guardar"
method="POST"
enctype="multipart/form-data">

@csrf
@if ($errors->any())

<div class="alert alert-danger">

<ul>

@foreach ($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Título
</label>

<input
type="text"
name="titulo"
class="form-control"
placeholder="Ej: PERDIDO"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Estado
</label>

<select
name="estado"
class="form-control">

<option value="perdido">
🔴 Perdido
</option>

<option value="encontrado">
🟢 Encontrado
</option>

<option value="reunido">
🔵 Reunido
</option>

</select>

</div>

</div>

<hr>

<h5 class="mb-3">
🐾 Información de la Mascota
</h5>

<div class="row">

<div class="col-md-6 mb-3">

<label>
Especie
</label>

<input
type="text"
name="especie"
class="form-control"
placeholder="Perro, Gato...">

</div>

<div class="col-md-6 mb-3">

<label>
Raza
</label>

<input
type="text"
name="raza"
class="form-control"
placeholder="Labrador, Criollo...">

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>
Color
</label>

<input
type="text"
name="color"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>
Sexo
</label>

<select
name="sexo"
class="form-control">

<option value="macho">
Macho
</option>

<option value="hembra">
Hembra
</option>

<option value="desconocido">
Desconocido
</option>

</select>

</div>

</div>

<hr>

<h5 class="mb-3">
📍 Ubicación
</h5>

<div class="mb-3">

<label>
Dirección
</label>

<input
type="text"
name="direccion"
class="form-control"
placeholder="Lugar donde fue visto">

</div>

<div class="mb-3">

<label>
Localidad
</label>

<input
type="text"
name="localidad"
class="form-control"
placeholder="Suba, Engativá, Kennedy...">

</div>

<hr>

<h5 class="mb-3">
📝 Descripción
</h5>

<div class="mb-3">

<textarea
name="descripcion"
rows="5"
class="form-control"
placeholder="Describe la mascota..."
required></textarea>

</div>

<hr>

<h5 class="mb-3">
📸 Fotografías
</h5>

<div class="mb-3">

<input
type="file"
name="imagenes[]"
multiple
class="form-control">

</div>

<div class="d-grid">

<button
type="submit"
class="btn btn-success btn-lg">

🐾 Publicar Reporte

</button>

</div>

</form>

</div>

</div>

</div>

</div>

@endsection