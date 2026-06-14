<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Seguimiento - BackHome 🐾</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
</head>
<body style="background-color: #fff9fc;">

    <nav class="navbar navbar-expand-xl custom-navbar sticky-top bg-white shadow-sm p-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-decoration-none" href="/" style="color: #ff9dc3;">
                🐾 BackHome / <span class="text-muted small">Editar Reporte</span>
            </a>
            <a href="/profile" class="btn btn-outline-secondary btn-sm">Volver a Mi Cuenta</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 p-4 rounded-4 bg-white">
                    <h3 class="fw-bold mb-4" style="color: #ff9dc3;">✏️ Modificar Reporte de Seguimiento</h3>

                    <form action="/seguimientos/{{ $reporte->id_seguimiento }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Título del Reporte</label>
                            <input type="text" name="titulo" class="form-control custom-input" value="{{ old('titulo', $reporte->titulo) }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Estado del Reporte</label>
                                <select name="estado" class="form-select custom-input" required>
                                    <option value="perdido" {{ $reporte->estado_reporte == 'perdido' ? 'selected' : '' }}>🔴 Perdido</option>
                                    <option value="encontrado" {{ $reporte->estado_reporte == 'encontrado' ? 'selected' : '' }}>🟢 Encontrado</option>
                                    <option value="reunido" {{ $reporte->estado_reporte == 'reunido' ? 'selected' : '' }}>🔵 Reunido</option>
                                    <option value="cerrado" {{ $reporte->estado_reporte == 'cerrado' ? 'selected' : '' }}>⚫ Cerrado</option>
                                </select>
                            </div> 


                        </div>


                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success px-4 fw-bold text-white rounded-3" style="background-color: #28a745;">
                                💾 GUARDAR CAMBIOS
                                </button>
</form> <form action="/seguimientos/{{ $reporte->id_seguimiento }}" method="POST" onsubmit="return confirm('¿Estás completamente seguro de que deseas eliminar este reporte? Esta acción no se puede deshacer. 🐾');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger fw-bold px-4" style="border-radius: 50px;">
        🗑️ Eliminar Reporte
    </button>
</form>
                            </button>
                            <a href="/profile" class="btn btn-secondary px-4 rounded-3">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>