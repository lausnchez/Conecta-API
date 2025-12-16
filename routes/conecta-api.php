<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\EventosController;
use App\Http\Controllers\CategoriasController;

Route::prefix('v1')->group(function () {
    Route::get('/prueba', function () {
        return "Ruta de prueba";
    });
    
    // Eventos
    Route::get('/eventos', [EventosController::class, 'getAll']);
    Route::get('/eventos/{id}', [EventosController::class, 'getEventoById']);

    // Categorias
    Route::get('/eventos', [EventosController::class, 'getAll']);
    Route::get('/eventos/{id}', [EventosController::class, 'getEventoById']);
    
});