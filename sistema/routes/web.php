<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoporteController;

Route::middleware(['auth'])->group(function () {
    Route::get('/contacto', function () {
        return view('contacto');
    })->name('contacto');

    Route::post('/soporte/store', [SoporteController::class, 'store'])->name('soporte.store');
});

Route::get('/', [SeguimientoController::class, 'index'])->name('seguimientos.index');
Route::get('/historial/{id}', [SeguimientoController::class, 'historial'])->name('seguimientos.historial');

Route::get('/cuenta-restringida', function () {
    if (!Auth::check()) return redirect('/login');
    return view('auth.suspendido');
})->name('cuenta.restringida');


Route::middleware('auth')->group(function () {

    Route::get('/perfil/{id_persona}', [ProfileController::class, 'verPerfil'])->name('profile.view');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/descargar-reportes', [PdfController::class, 'descargar'])->name('descargar.reportes');

  
    Route::get('/seguimientos/{id}/edit', [SeguimientoController::class, 'edit'])->name('seguimientos.edit');
    Route::put('/seguimientos/{id}', [SeguimientoController::class, 'update'])->name('seguimientos.update');
    Route::delete('/seguimientos/{id}', [SeguimientoController::class, 'destroy'])->name('seguimientos.destroy');

  
    Route::middleware('cliente')->group(function () {
        Route::get('/crear', [SeguimientoController::class, 'create'])->name('seguimientos.create');
        Route::post('/guardar', [SeguimientoController::class, 'store'])->name('seguimientos.store');
    });

   
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::resource('usuarios', UsuarioController::class);
        Route::get('/animales', [AnimalController::class, 'index'])->name('animales.index');
        Route::get('/reportes', function () {
            return view('reportes.index');
        })->name('reportes.index');
    });

});

require __DIR__.'/auth.php';