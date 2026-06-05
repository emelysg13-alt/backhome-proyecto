<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Back Home</title>

<link rel="stylesheet"
href="{{ asset('css/admin.css') }}">

</head>

<body>

<div class="sidebar">

<div class="logo">
Back Home
</div>

<a href="{{ route('admin.dashboard') }}" class="menu-btn">
🏠 Inicio
</a>

<a href="{{ route('usuarios.index') }}" class="menu-btn">
👥 Usuarios
</a>

<a href="{{ route('usuarios.create') }}" class="menu-btn">
➕ Registrar Usuario
</a>

<a href="{{ route('animales.index') }}" class="menu-btn">
🐶 Animales
</a>

<a href="{{ route('reportes.index') }}" class="menu-btn">
📄 Reportes
</a>

<form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;">
            @csrf
            <button type="submit" class="menu-btn" style="width: 100%; text-align: left">
                🚪 Cerrar sesión
            </button>
        </form>

</div>

<div class="contenido">

@yield('content')

</div>

</body>

</html>