@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white text-center">
            <h3>Editar Usuario</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('usuarios.update', $usuario->id_persona) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Primer Nombre</label>
                    <input type="text" name="primer_nombre" class="form-control"
                        value="{{ $usuario->primer_nombre }}">
                </div>

                <div class="mb-3">
                    <label>Segundo Nombre</label>
                    <input type="text" name="segundo_nombre" class="form-control"
                        value="{{ $usuario->segundo_nombre }}">
                </div>

                <div class="mb-3">
                    <label>Primer Apellido</label>
                    <input type="text" name="primer_apellido" class="form-control"
                        value="{{ $usuario->primer_apellido }}">
                </div>

                <div class="mb-3">
                    <label>Segundo Apellido</label>
                    <input type="text" name="segundo_apellido" class="form-control"
                        value="{{ $usuario->segundo_apellido }}">
                </div>

                <div class="mb-3">
                    <label>Correo</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ $usuario->email }}">
                </div>

                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="numero_tel" class="form-control"
                        value="{{ $usuario->numero_tel }}">
                </div>

                <div class="mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control">

                        <option value="activo"
                            {{ $usuario->estado == 'activo' ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="bloqueado"
                            {{ $usuario->estado == 'bloqueado' ? 'selected' : '' }}>
                            Bloqueado
                        </option>

                        <option value="suspendido"
                            {{ $usuario->estado == 'suspendido' ? 'selected' : '' }}>
                            Suspendido
                        </option>

                    </select>
                </div>

                <div class="d-flex gap-2">

                    <button class="btn btn-success">
                        Actualizar
                    </button>

                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection