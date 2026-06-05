@extends('layouts.admin')
@section('content')

<div class="container mt-4">

    <div class="card shadow border-0">
        <div class="card-header text-center text-white" style="background: #ffb6c1;">
            <h2>🐾 Reportes de Animales en Bogotá</h2>
            <p class="mb-0">Registro de avistamientos en diferentes localidades</p>
        </div>

        <div class="card-body" style="background: #fff8dc;">

            <!-- REPORTE 1 -->
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body" style="background: #ffe4e1;">
                    <h5>👤 Laura Gómez</h5>
                    <p><strong>Ciudad:</strong> Bogotá</p>
                    <p><strong>Localidad:</strong> Suba</p>
                    <p><strong>Animal:</strong> Zorro 🦊</p>
                    <p>Se observó un zorro en zona verde durante la noche.</p>
                </div>
            </div>

            <!-- REPORTE 2 -->
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body" style="background: #fff0f5;">
                    <h5>👤 Andrés Martínez</h5>
                    <p><strong>Ciudad:</strong> Bogotá</p>
                    <p><strong>Localidad:</strong> Chapinero</p>
                    <p><strong>Animal:</strong> Ardilla 🐿️</p>
                    <p>Una ardilla fue vista en un parque urbano buscando comida.</p>
                </div>
            </div>

            <!-- REPORTE 3 -->
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body" style="background: #fdf5e6;">
                    <h5>👤 Mariana Rodríguez</h5>
                    <p><strong>Ciudad:</strong> Bogotá</p>
                    <p><strong>Localidad:</strong> Kennedy</p>
                    <p><strong>Animal:</strong> Perro callejero 🐶</p>
                    <p>Se encontró un perro en estación de transporte público.</p>
                </div>
            </div>

            <!-- REPORTE 4 -->
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body" style="background: #ffe4b5;">
                    <h5>👤 Carlos Pérez</h5>
                    <p><strong>Ciudad:</strong> Bogotá</p>
                    <p><strong>Localidad:</strong> Engativá</p>
                    <p><strong>Animal:</strong> Búho 🦉</p>
                    <p>Se avistó un búho en un árbol alto en la noche.</p>
                </div>
            </div>

            <!-- REPORTE 5 -->
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body" style="background: #f0fff0;">
                    <h5>👤 Sofía Ramírez</h5>
                    <p><strong>Ciudad:</strong> Bogotá</p>
                    <p><strong>Localidad:</strong> Bosa</p>
                    <p><strong>Animal:</strong> Gato montés 🐱</p>
                    <p>Se reportó un felino salvaje cerca de zona rural.</p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection