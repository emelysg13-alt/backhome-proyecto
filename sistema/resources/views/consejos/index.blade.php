<!DOCTYPE html>
<html>
<head>

<title>Consejos para Mascotas</title>
<div class="mb-4">
    <a href="{{ url('/') }}"
       class="btn shadow-sm"
       style="
            background: #ffffff;
            color: #ff5d9e;
            border: 2px solid #ffb6d5;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: bold;
       ">
        ← Volver a Inicio
    </a>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

<style>

body{
    background: linear-gradient(135deg,#fff4f8,#ffe8f1);
    min-height:100vh;
    font-family:'Segoe UI',sans-serif;
}

/* Caja principal */
.container{
    background:rgba(255,255,255,.6);
    backdrop-filter: blur(15px);
    border-radius:35px;
    padding:50px;
    margin-top:50px;
    box-shadow:0 10px 30px rgba(255,105,180,.15);
}

/* Título */
h1{
    text-align:center;
    color:#ff5d9e;
    font-size:55px;
    font-weight:800;
    margin-bottom:40px;
}

/* Botón agregar */
.btn-primary{
    background:linear-gradient(to right,#ff8fb8,#ff5d9e);
    border:none;
    border-radius:50px;
    padding:15px 25px;
    font-weight:bold;
    box-shadow:0 5px 15px rgba(255,105,180,.3);
}

.btn-primary:hover{
    transform:scale(1.05);
}

/* Tabla */
.table{
    overflow:hidden;
    border-radius:25px;
    background:white;
    box-shadow:0 10px 30px rgba(255,105,180,.15);
}

thead{
    background:#ffc7da;
}

th{
    color:#8f3c5f !important;
    font-size:18px;
}

tbody tr{
    transition:.3s;
}

tbody tr:hover{
    background:#fff4f8;
}

/* Botones */
.btn-warning{
    background:#ff9fc5;
    color:white;
    border:none;
    border-radius:20px;
    font-weight:bold;
}

.btn-danger{
    background:#ff6f91;
    border:none;
    border-radius:20px;
    font-weight:bold;
}

/* Huellas */
.huella1{
position:fixed;
top:50px;
left:40px;
font-size:60px;
opacity:.1;
}

.huella2{
position:fixed;
right:60px;
top:100px;
font-size:60px;
opacity:.1;
}

.huella3{
position:fixed;
left:100px;
bottom:50px;
font-size:70px;
opacity:.1;
}

.huella4{
position:fixed;
right:100px;
bottom:50px;
font-size:70px;
opacity:.1;
}

</style>
</style>

</head>
<body>
<div class="huella1">🐾</div>
<div class="huella2">🐾</div>
<div class="huella3">🐾</div>
<div class="huella4">🐾</div>

<div class="container mt-5">

<h1 class="mb-4">
Consejos para Mascotas
</h1>

<button class="btn btn-primary mb-3" onclick="agregar()">
Agregar Consejo
</button>

<table class="table table-bordered">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Título</th>
<th>Descripción</th>
<th>Acciones</th>
</tr>

</thead>

<tbody id="tabla"></tbody>

</table>

</div>

<script>

cargar();

function cargar()
{
fetch('/api/consejos')

.then(res=>res.json())

.then(data=>{

let tabla='';

data.forEach(c=>{

tabla += `
<tr>

<td>${c.id}</td>

<td>${c.titulo}</td>

<td>${c.descripcion}</td>

<td>

<button class="btn btn-warning"
onclick="editar(${c.id})">

Editar

</button>

<button class="btn btn-danger"
onclick="eliminarConsejo(${c.id})">

Eliminar

</button>

</td>

</tr>
`;

});

document.getElementById('tabla').innerHTML=tabla;

});

}


function agregar()
{
let titulo = prompt("Título");

let descripcion = prompt("Descripción");

fetch('/api/consejos',{

method:'POST',

headers:{
'Content-Type':'application/json'
},

body:JSON.stringify({
titulo,
descripcion
})

})

.then(()=>cargar());

}


function editar(id)
{

let titulo = prompt("Nuevo título");

let descripcion = prompt("Nueva descripción");

fetch('/api/consejos/'+id,{

method:'PUT',

headers:{
'Content-Type':'application/json'
},

body:JSON.stringify({

titulo,
descripcion

})

})

.then(()=>cargar());

}


function eliminarConsejo(id)
{

if(confirm("¿Deseas eliminar este consejo?"))
{

fetch('/api/consejos/'+id,{

method:'DELETE'

})

.then(()=>cargar());

}

}

</script>

</body>
</html>