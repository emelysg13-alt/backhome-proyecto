@extends('layouts.admin')

@section('content')

<style>
.card-form {
    background: #fff0f6; /* rosa claro */
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.title {
    text-align: center;
    color: #444;
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
    margin-top: 10px;
}

.form-control {
    border-radius: 12px;
    padding: 10px;
}

.btn-guardar {
    background: #ffe680; /* amarillo pastel */
    border: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: bold;
}

.btn-guardar:hover {
    background: #ffd24d;
}

.btn-volver {
    background: #f8c8dc;
    border: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: bold;
}
</style>

<div class="container mt-4">

    <div class="card-form">

        <h2 class="title">Registrar Nuevo Usuario</h2>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Tipo de Documento</label>
                <select name="t_documento_id" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </div>

            <div class="form-group">
                <label>Número de Documento</label>
                <input type="text" name="n_documento" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Primer Nombre</label>
                <input type="text" name="primer_nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Segundo Nombre</label>
                <input type="text" name="segundo_nombre" class="form-control">
            </div>

            <div class="form-group">
                <label>Primer Apellido</label>
                <input type="text" name="primer_apellido" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Segundo Apellido</label>
                <input type="text" name="segundo_apellido" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="numero_tel" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="activo">Activo</option>
                    <option value="bloqueado">Bloqueado</option>
                    <option value="suspendido">Suspendido</option>
                </select>
            </div>

            <br>

            <button class="btn-guardar" type="submit">
                Guardar Usuario
            </button>

            <a href="{{ route('usuarios.index') }}" class="btn-volver">
                Volver
            </a>

        </form>

    </div>

</div>

@endsection