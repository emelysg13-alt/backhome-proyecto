<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas</title>
</head>
<body>
    
<h2>Entradas</h2>

<table>
    <thead>
        <th>ID</th>
        <th>Título</th>
        <th>Tags</th>
    </thead>
<tbody> 
@foreach($entradas as $entrada)
    
<tr>

    <td>{{ $entrada->id }}</td>
    <td>{{ $entrada->titulo }}</td>
    <td>{{ $entrada->tag }}</td>
    
</tr>


@endforeach
</tbody>
</table>


</body>
</html>