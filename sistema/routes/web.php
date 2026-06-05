<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\PdfController;


Route::get('/descargar-reportes', [PdfController::class, 'descargar'])
    ->name('descargar.reportes');


//ADMINISTRADOR

Route::resource(
'usuarios',
UsuarioController::class
);

Route::get(
'/animales',
[AnimalController::class,'index']
)->name('animales.index');

Route::get('/reportes', function () {
    return view('reportes.index');
})->name('reportes.index');


//SEGUIMIENTOS

Route::get('/', [SeguimientoController::class,'index']);

Route::middleware(['auth', 'cliente'])->group(function () {

    Route::get('/crear',
        [SeguimientoController::class,'create'])
        ->name('seguimientos.create');

    Route::post('/guardar',
        [SeguimientoController::class,'store'])
        ->name('seguimientos.store');

});

Route::delete('/eliminar/{id}', [SeguimientoController::class,'destroy']);

Route::get('/historial/{id}', [SeguimientoController::class,'historial']);


/*Route::get('/', function () {
    return view('welcome');
});
*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';







Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::resource('usuarios', UsuarioController::class);

    Route::get('/animales', [AnimalController::class,'index'])
        ->name('animales.index');

    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');

});