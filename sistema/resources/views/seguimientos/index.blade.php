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
    <div class="card shadow h-100 border-0" style="border-radius: 20px; overflow: hidden;">
        
        @php
            // 🐾 SOLUCCIÓN: Buscamos de forma segura la primera imagen asociada al reporte
            $fotoMascota = \App\Models\ImagenSeguimiento::where('seguimiento_id', $reporte->id_seguimiento)->first();
        @endphp

        <img src="{{ $fotoMascota ? asset('storage/' . $fotoMascota->ruta_imagen) : 'https://i.pinimg.com/736x/e0/e2/49/e0e249dbb878081e427f627d91d29aeb.jpg' }}" 
             class="card-img-top" 
             style="height:250px; object-fit:cover;" 
             alt="Imagen del reporte">

        <div class="card-body">
            @if($reporte->estado_reporte == 'perdido')
                <span class="badge bg-danger mb-2">PERDIDO</span>
            @elseif($reporte->estado_reporte == 'encontrado')
                <span class="badge bg-success mb-2">ENCONTRADO</span>
            @else
                <span class="badge bg-primary mb-2">REUNIDO</span>
            @endif

            <h4 class="fw-bold" style="color: #333;">{{ strtoupper($reporte->titulo) }}</h4>
            <hr>

            <p class="mb-1">📅 <strong>Fecha:</strong> {{ date('d/m/Y', strtotime($reporte->fecha_publicacion)) }}</p>
            <p class="mb-1">🐾 <strong>Especie:</strong>
                @if($reporte->animal && $reporte->animal->domestico)
                    {{ $reporte->animal->domestico->especie }}
                @elseif($reporte->animal && $reporte->animal->exotico)
                    {{ $reporte->animal->exotico->especie }}
                @else
                    No registrada
                @endif
            </p>
            <p class="mb-1">🐶 <strong>Raza:</strong> {{ $reporte->animal->domestico->raza ?? 'No registrada' }}</p>
            <p class="mb-1">🎨 <strong>Color:</strong> {{ $reporte->animal->color ?? 'No registrado' }}</p>
            <p class="mb-1">⚥ <strong>Sexo:</strong> {{ ucfirst($reporte->animal->sexo ?? 'No registrado') }}</p>
            <p class="mb-1">📍 <strong>Localidad:</strong> {{ $reporte->lugar->localidad->n_localidad ?? 'No registrada' }}</p>
            <p class="mb-1">📌 <strong>Dirección:</strong> {{ $reporte->lugar->direccion ?? 'No registrada' }}</p>
            <p class="text-muted small mt-2 text-truncate">📝 <strong>Descripción:</strong> {{ $reporte->descripcion }}</p>
        </div>

      
<div class="card-footer bg-transparent border-0 pb-4 px-3 d-flex gap-2">
    @auth
  
        <a href="/perfil/{{ $reporte->cliente->persona_id ?? '' }}" class="btn w-100 fw-bold text-white shadow-sm" style="background-color: #ff9dc3; border: none; border-radius: 50px;">
            🔍 Contactar
        </a>
    @else
      
        <a href="/login" class="btn w-100 fw-bold btn-secondary small" style="border-radius: 50px; font-size:0.85rem;">
            🔑 Logueate para Contactar
        </a>
    @endauth

    <a href="/historial/{{ $reporte->id_seguimiento }}" class="btn btn-light border fw-bold text-muted" style="border-radius: 50px; min-width: 100px;">
        Historial
    </a>
</div>
    </div>

    </div>
@empty
<div class="col-12 alert alert-warning text-center rounded-4">
    No existen reportes registrados en este momento. 🐾
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