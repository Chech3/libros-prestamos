<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DestinarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/libros', LibroController::class);
    Route::resource('/prestamos', PrestamoController::class);
    Route::get('/reporte-prestamo/{prestamo}', [PrestamoController::class, 'imprimir'])->name('imprimir.prestamo');
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/destinarios', DestinarioController::class);

    Route::get('/reporte-libros', [ReporteController::class, 'index'])->name('reporte.libros');
    Route::post('/reporte-libros', [ReporteController::class, 'generarReporte'])->name('reporte.libros.generar');

    

});


require __DIR__ . '/auth.php';
