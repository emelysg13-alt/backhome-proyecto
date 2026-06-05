@extends('layouts.admin')

@section('content')
@if(session('success'))

<div class="alert-success">
    {{ session('success') }}
</div>

@endif
<div class="card">

    <h1>Administración de Usuarios</h1>

    <a href="{{ route('usuarios.create') }}" class="btn-ver">
        Nuevo Usuario
    </a>

    <br><br>

    <table>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>

        @foreach($usuarios as $usuario)

        <tr>

            <td>{{ $usuario->id_persona }}</td>

            <td>
                {{ $usuario->primer_nombre }}
                {{ $usuario->primer_apellido }}
            </td>

            <td>{{ $usuario->email }}</td>

            <td>{{ $usuario->numero_tel }}</td>

            <td>

                <a
                href="{{ route('usuarios.show',$usuario->id_persona) }}"
                class="btn-ver">
                Ver
                </a>

                <a
                href="{{ route('usuarios.edit',$usuario->id_persona) }}"
                class="btn-editar">
                Editar
                </a>

                <form
                action="{{ route('usuarios.destroy',$usuario->id_persona) }}"
                method="POST"
                style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button class="btn-eliminar">
                        Eliminar
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</div>

@endsection