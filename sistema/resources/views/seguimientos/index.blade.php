@extends('layouts.backhome')

@section('contenido')

<div class="text-center mb-5">

    <h2>🐾 Plataforma de Búsqueda de Mascotas</h2>

    <p class="text-muted">
        Ayuda a reunir mascotas con sus familias
    </p>

</div>

<div class="mb-4">

    <input
    type="text"
    id="buscador"
    class="form-control form-control-lg"
    placeholder="🔍 Buscar reporte...">

</div>

<div class="text-center mb-4">

    <a href="/" class="btn btn-dark">
        Todas
    </a>

    <a href="/?estado=perdido"
       class="btn btn-danger">
        Perdidas
    </a>

    <a href="/?estado=encontrado"
       class="btn btn-success">
        Encontradas
    </a>

    <a href="/?estado=reunido"
       class="btn btn-primary">
        Reunidas
    </a>

</div>

<div class="row mb-5">

    <div class="col-md-4">

        <div class="card text-center shadow">

            <div class="card-body">

                <h3>
                    {{ $reportes->where('estado_reporte','perdido')->count() }}
                </h3>

                <strong>
                    Mascotas Perdidas
                </strong>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-center shadow">

            <div class="card-body">

                <h3>
                    {{ $reportes->where('estado_reporte','encontrado')->count() }}
                </h3>

                <strong>
                    Mascotas Encontradas
                </strong>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-center shadow">

            <div class="card-body">

                <h3>
                    {{ $reportes->where('estado_reporte','reunido')->count() }}
                </h3>

                <strong>
                    Mascotas Reunidas
                </strong>

            </div>

        </div>

    </div>

</div>

<div class="row">

@forelse($reportes as $reporte)

<div class="col-md-6 col-lg-4 mb-4 tarjeta-reporte">

<div class="card shadow h-100">

<img
src="{{ asset('storage/' . ($reporte->imagenPrincipal->ruta_imagen ?? 'sin-imagen.jpg')) }}"
class="card-img-top"
style="height:250px; object-fit:cover;"
alt="Imagen del reporte">

<div class="card-body">

@if($reporte->estado_reporte == 'perdido')

<span class="badge bg-danger mb-2">
PERDIDO
</span>

@elseif($reporte->estado_reporte == 'encontrado')

<span class="badge bg-success mb-2">
ENCONTRADO
</span>

@else

<span class="badge bg-primary mb-2">
REUNIDO
</span>

@endif

<h4>

{{ strtoupper($reporte->titulo) }}

</h4>

<hr>

<p>

📅 <strong>Fecha:</strong>

{{ date('d/m/Y', strtotime($reporte->fecha_publicacion)) }}

</p>

<p>

🐾 <strong>Especie:</strong>

@if($reporte->animal && $reporte->animal->domestico)

{{ $reporte->animal->domestico->especie }}

@elseif($reporte->animal && $reporte->animal->exotico)

{{ $reporte->animal->exotico->especie }}

@else

No registrada

@endif

</p>

<p>

🐶 <strong>Raza:</strong>

{{ $reporte->animal->domestico->raza ?? 'No registrada' }}

</p>

<p>

🎨 <strong>Color:</strong>

{{ $reporte->animal->color ?? 'No registrado' }}

</p>

<p>

⚥ <strong>Sexo:</strong>

{{ ucfirst($reporte->animal->sexo ?? 'No registrado') }}

</p>

<p>

📍 <strong>Localidad:</strong>

{{ $reporte->lugar->localidad->n_localidad ?? 'No registrada' }}

</p>

<p>

📌 <strong>Dirección:</strong>

{{ $reporte->lugar->direccion ?? 'No registrada' }}

</p>

<p>

📝 <strong>Descripción:</strong>

{{ $reporte->descripcion }}

</p>

</div>

<div class="card-footer text-center">

<a
href="/historial/{{ $reporte->id_seguimiento }}"
class="btn btn-info mb-2">

Ver Historial

</a>

<br>

<a
href="/ver/{{ $reporte->id_seguimiento }}"
class="btn btn-primary mb-2">

Ver

</a>

<a
href="/editar/{{ $reporte->id_seguimiento }}"
class="btn btn-warning mb-2">

Editar

</a>

<form
action="/eliminar/{{ $reporte->id_seguimiento }}"
method="POST"
style="display:inline;">

@csrf
@method('DELETE')

<button
type="submit"
class="btn btn-danger"
onclick="return confirm('¿Deseas eliminar este reporte?')">

Eliminar

</button>

</form>

</div>

</div>

</div>

@empty

<div class="alert alert-warning text-center">

No existen reportes registrados.

</div>

@endforelse

</div>

<script>

document.getElementById('buscador')
.addEventListener('keyup', function(){

let texto = this.value.toLowerCase();

let tarjetas =
document.querySelectorAll('.tarjeta-reporte');

tarjetas.forEach(function(tarjeta){

if(
tarjeta.innerText
.toLowerCase()
.includes(texto)
)
{
tarjeta.style.display='block';
}
else
{
tarjeta.style.display='none';
}

});

});

</script>

@endsection