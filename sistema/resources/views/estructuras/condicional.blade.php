<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estructuras de Control</title>
</head>
<body>
    <h1> Su nota es: {{$nota}}</h1>       
   <p>
    Situación: 
    @if ($nota >= 10.5)
        Aprobado
    @else
        Reprobado
    @endif
</p> 

<p> 
    Categoria:
    @if ($nota>=0 && $nota < 6)
        Pésimo
    @elseif ($nota >= 6 && $nota < 10.5)
        Bajo
    @elseif ($nota >= 10.5 && $nota < 14)
        Regular
    @elseif ($nota >= 14 && $nota < 17)
        Bueno
    @elseif ($nota >= 17 && $nota <= 20)
        Excelente
        @else
        Nota no válida
    @endif
</p> 
</body>
</html>