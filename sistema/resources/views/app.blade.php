<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema')</title>
    <!-- Agrega aquí tus estilos CSS o enlaces a archivos CSS-->
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @stack('css') 

</head>
<body>
    <header>
      <h1 class="texto-rojo">Bienvenido a mi sistema</h1>
    </header>
<!-- Incluir el menú desde un archivo parcial -->
    @include('partials.menu')
    <main>
        @yield('contenido')   
    </main>
    <footer>
        <p> 2026 - Sistema </p>
    </footer>

    <!-- Aplica scripts -->
    @stack('scripts')   
    
</body>
</html>