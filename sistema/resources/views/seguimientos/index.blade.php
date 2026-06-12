@extends('layouts.backhome')

@section('contenido')

<div class="row justify-content-center filter-tabs-wrapper">
    <div class="col-12 col-lg-10">
        <div class="filter-tabs-container shadow">
            <a href="/" class="filter-tab-item {{ !request('estado') ? 'active' : '' }}">
                <div class="tab-icon-circle">
                    <i class="bi bi-paw-fill"></i>
                </div>
                <span class="tab-text">Todas</span>
            </a>
            
            <a href="/?estado=perdido" class="filter-tab-item {{ request('estado') == 'perdido' ? 'active' : '' }}">
                <div class="tab-icon-circle icon-perdido">
                    <i class="bi bi-paw-fill"></i>
                </div>
                <span class="tab-text">Perdidas</span>
            </a>

            <a href="/?estado=encontrado" class="filter-tab-item {{ request('estado') == 'encontrado' ? 'active' : '' }}">
                <div class="tab-icon-circle icon-encontrado">
                    <i class="bi bi-paw-fill"></i>
                </div>
                <span class="tab-text">Encontradas</span>
            </a>

            <a href="/?estado=reunido" class="filter-tab-item {{ request('estado') == 'reunido' ? 'active' : '' }}">
                <div class="tab-icon-circle icon-reunido">
                    <i class="bi bi-paw-fill"></i>
                </div>
                <span class="tab-text">Reunidas</span>
            </a>
        </div>
    </div>
</div>

<div class="mb-5 row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <input
            type="text"
            id="buscador"
            class="form-control form-control-lg shadow-sm"
            placeholder="🔍 Buscar reporte...">
    </div>
</div>

<div class="row">
@forelse($reportes as $reporte)
<div class="col-md-6 col-lg-4 mb-4 tarjeta-reporte">
    <div class="card shadow h-100">
        <img src="{{ $reporte->imagenPrincipal->ruta_imagen }}" class="card-img-top" style="height:250px; object-fit:cover;" alt="Imagen del reporte">

        <div class="card-body">
            @if($reporte->estado_reporte == 'perdido')
                <span class="badge bg-danger mb-2">PERDIDO</span>
            @elseif($reporte->estado_reporte == 'encontrado')
                <span class="badge bg-success mb-2">ENCONTRADO</span>
            @else
                <span class="badge bg-primary mb-2">REUNIDO</span>
            @endif

            <h4>{{ strtoupper($reporte->titulo) }}</h4>
            <hr>

            <p>📅 <strong>Fecha:</strong> {{ date('d/m/Y', strtotime($reporte->fecha_publicacion)) }}</p>
            <p>🐾 <strong>Especie:</strong>
                @if($reporte->animal && $reporte->animal->domestico)
                    {{ $reporte->animal->domestico->especie }}
                @elseif($reporte->animal && $reporte->animal->exotico)
                    {{ $reporte->animal->exotico->especie }}
                @else
                    No registrada
                @endif
            </p>
            <p>🐶 <strong>Raza:</strong> {{ $reporte->animal->domestico->raza ?? 'No registrada' }}</p>
            <p>🎨 <strong>Color:</strong> {{ $reporte->animal->color ?? 'No registrado' }}</p>
            <p>⚥ <strong>Sexo:</strong> {{ ucfirst($reporte->animal->sexo ?? 'No registrado') }}</p>
            <p>📍 <strong>Localidad:</strong> {{ $reporte->lugar->localidad->n_localidad ?? 'No registrada' }}</p>
            <p>📌 <strong>Dirección:</strong> {{ $reporte->lugar->direccion ?? 'No registrada' }}</p>
            <p>📝 <strong>Descripción:</strong> {{ $reporte->descripcion }}</p>
        </div>

        <div class="card-footer text-center bg-transparent border-0 pb-4">
            <a href="/historial/{{ $reporte->id_seguimiento }}" class="btn btn-info">
                Ver Historial
            </a>
        </div>
    </div>
</div>
@empty
<div class="col-12 alert alert-warning text-center">
    No existen reportes registrados.
</div>
@endforelse
</div>

<script>
document.getElementById('buscador').addEventListener('keyup', function(){
    let texto = this.value.toLowerCase();
    let tarjetas = document.querySelectorAll('.tarjeta-reporte');

    tarjetas.forEach(function(tarjeta){
        if(tarjeta.innerText.toLowerCase().includes(texto)) {
            tarjeta.style.display='block';
        } else {
            tarjeta.style.display='none';
        }
    });
});
</script>
@endsection