<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Back Home 🐾</title>

<link href="https://fonts.googleapis.com/css2?family=Playwrite+NZ+Basic&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Playwrite NZ Basic', cursive;
background:linear-gradient(180deg,#ffd9ec,#fff4cc);
background-image:
url("https://www.transparenttextures.com/patterns/paw-print.png"),
linear-gradient(180deg,#ffd9ec,#fff4cc);
background-blend-mode:overlay;
min-height:100vh;
}

header{
background:linear-gradient(90deg,#ffc2e2,#ffe7a6);
padding:25px;
text-align:center;
box-shadow:0px 3px 12px rgba(0,0,0,0.1);
}

nav{
display:flex;
justify-content:center;
gap:20px;
padding:15px;
}

nav a{
text-decoration:none;
background:#ffb6d5;
padding:10px 15px;
border-radius:10px;
color:#333;
font-weight:bold;
}

.card{
border:none;
border-radius:20px;
overflow:hidden;
}

.card:hover{
transform:translateY(-5px);
transition:0.3s;
}

.btn-info{
background:#8fd3ff;
border:none;
}

</style>

</head>

<body>

<header>

<h1>🐾 Back Home</h1>

<p>
Encuentra mascotas perdidas o ayúdalas a volver a casa
</p>

</header>

<nav>

<a href="{{ route('descargar.reportes') }}"
   class="btn btn-danger">
   📄 Descargar Reportes de Animales
</a>

<a href="/">
🏠 Inicio
</a>

@auth

<a href="/crear" class="btn btn-success">
    🐾 Crear Seguimiento
</a>

@endauth
 @guest

<p>
    Debes iniciar sesión para crear un seguimiento.
</p>

<a href="{{ route('login') }}">
    Iniciar Sesión
</a>

@endguest


@auth

    <a href="{{ route('profile.edit') }}">
    👤 Mi Cuenta
</a>

@endauth

@guest

    <a href="{{ route('register') }}">
        Registrarse
    </a>

@endguest
 
@auth

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit">
        Cerrar Sesión
    </button>
</form>

@endauth


</nav>

<div class="container mt-4">

@yield('contenido')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>