@extends('layouts.admin')

@section('content')

<div class="card">

    <h1>Información del Usuario</h1>

    <div class="detalle-usuario">

        <div class="dato">
            <span>Documento</span>
            <p>{{ $usuario->n_documento }}</p>
        </div>

        <div class="dato">
            <span>Nombre</span>
            <p>{{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }}</p>
        </div>

        <div class="dato">
            <span>Apellido</span>
            <p>{{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}</p>
        </div>

        <div class="dato">
            <span>Correo</span>
            <p>{{ $usuario->email }}</p>
        </div>

        <div class="dato">
            <span>Teléfono</span>
            <p>{{ $usuario->numero_tel }}</p>
        </div>

        <div class="dato">
            <span>Estado</span>
            <p>{{ $usuario->estado }}</p>
        </div>

    </div>

    <div class="acciones">
        <a href="{{ route('usuarios.index') }}" class="btn-volver">
            Volver
        </a>

        <a href="{{ route('usuarios.edit', $usuario->id_persona) }}"
           class="btn-editar">
            Editar
        </a>
    </div>

</div>

@endsection