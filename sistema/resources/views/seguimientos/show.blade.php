@extends('layouts.backhome')

@section('contenido')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow border-0" style="border-radius: 20px; overflow: hidden; background-color: #ffffff;">
                
                @php
                    // Buscamos de manera segura si el reporte tiene una foto asociada
                    $fotoMascota = \App\Models\ImagenSeguimiento::where('seguimiento_id', $reporte->id_seguimiento)->first();
                @endphp

                <img src="{{ $fotoMascota ? asset('storage/' . $fotoMascota->ruta_imagen) : 'https://i.pinimg.com/736x/e0/e2/49/e0e249dbb878081e427f627d91d29aeb.jpg' }}" 
                     class="card-img-top" 
                     style="height: 400px; object-fit: cover;" 
                     alt="Foto de la mascota">

                <div class="card-body p-4">
                    
                    @if($reporte->estado_reporte == 'perdido')
                        <span class="badge bg-danger mb-3 px-3 py-2 rounded-pill fw-bold" style="font-size: 0.9rem;">PERDIDO</span>
                    @elseif($reporte->estado_reporte == 'encontrado')
                        <span class="badge bg-success mb-3 px-3 py-2 rounded-pill fw-bold" style="font-size: 0.9rem;">ENCONTRADO</span>
                    @else
                        <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill fw-bold" style="font-size: 0.9rem;">REUNIDO</span>
                    @endif

                    <h2 class="fw-bold mb-3" style="color: #333;">{{ strtoupper($reporte->titulo) }}</h2>
                    <hr class="mb-4" style="border-color: #f1f1f1;">

                    <div class="row g-3 mb-4" style="font-size: 1.05rem;">
                        <div class="col-6">
                            <p class="mb-2">📅 <strong>Fecha:</strong> {{ date('d/m/Y', strtotime($reporte->fecha_publicacion)) }}</p>
                            <p class="mb-2">🐾 <strong>Especie:</strong>
                                @if($reporte->animal && $reporte->animal->domestico)
                                    {{ $reporte->animal->domestico->especie }}
                                @elseif($reporte->animal && $reporte->animal->exotico)
                                    {{ $reporte->animal->exotico->especie }}
                                @else
                                    No registrada
                                @endif
                            </p>
                            <p class="mb-2">🐶 <strong>Raza:</strong> {{ $reporte->animal->domestico->raza ?? 'No registrada' }}</p>
                        </div>
                        <div class="col-6">
                            <p class="mb-2">🎨 <strong>Color:</strong> {{ $reporte->animal->color ?? 'No registrado' }}</p>
                            <p class="mb-2">⚥ <strong>Sexo:</strong> {{ ucfirst($reporte->animal->sexo ?? 'No registrado') }}</p>
                            <p class="mb-2">📍 <strong>Localidad:</strong> {{ $reporte->lugar->localidad->n_localidad ?? 'No registrada' }}</p>
                        </div>
                        <div class="col-12 mt-2">
                            <p class="mb-2">📌 <strong>Dirección exacta:</strong> {{ $reporte->lugar->direccion ?? 'No registrada' }}</p>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4">
                        <h5 class="fw-bold text-secondary mb-2" style="font-size: 1.1rem;">📝 Descripción del caso:</h5>
                        <p class="text-muted m-0" style="line-height: 1.6;">{{ $reporte->descripcion }}</p>
                    </div>

                    <div class="d-flex gap-3 justify-content-between align-items-center mt-4">
                        <a href="/" class="btn btn-light border fw-bold px-4" style="border-radius: 50px;">
                            ⬅️ Volver al Inicio
                        </a>

                        @auth
                            @if($reporte->cliente && (int) $reporte->cliente->persona_id === (int) Auth::id())
                                <a href="/editar/{{ $reporte->id_seguimiento }}" class="btn btn-warning fw-bold px-4" style="border-radius: 50px;">
                                    ✏️ Editar Mi Reporte
                                </a>
                            @else
                                <a href="/perfil/{{ $reporte->cliente->persona_id ?? '' }}" class="btn fw-bold text-white px-4" style="background-color: #ff9dc3; border: none; border-radius: 50px;">
                                    🔍 Ver Perfil del Dueño
                                </a>
                            @endif
                        @else
                            <div class="alert alert-warning m-0 py-2 px-3 small rounded-pill">
                                ⚠️ <a href="/login" class="fw-bold text-decoration-none">Inicia sesión</a> para contactar.
                            </div>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection