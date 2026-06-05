<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foreach</title>
</head>
<body>
    @foreach($lista as $obj)
        <p>{{ $obj }}</p>
    @endforeach 

    @php
    function sumar($numero1, $numero2){
        return $numero1 + $numero2;
    } 
    @endphp

    <p> Resultado: {{ sumar(7, 10) }} </p>
</body>
</html>