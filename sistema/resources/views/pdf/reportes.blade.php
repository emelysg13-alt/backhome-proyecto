<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Reporte de Animales</title>

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid black;
            padding:8px;
            text-align:left;
        }

        th{
            background:#dddddd;
        }

        h1{
            text-align:center;
        }
    </style>
</head>
<body>

<h1>Reporte General de Animales</h1>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>

    @foreach($seguimientos as $seguimiento)

        <tr>
            <td>{{ $seguimiento->id_seguimiento }}</td>
            <td>{{ $seguimiento->titulo }}</td>
            <td>{{ $seguimiento->descripcion }}</td>
            <td>{{ $seguimiento->estado_reporte }}</td>
        </tr>

    @endforeach

    </tbody>

</table>

</body>
</html>