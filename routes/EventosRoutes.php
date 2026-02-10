<?php

use App\Http\Controllers\EventosController;
use Illuminate\Support\Facades\Route;


// Eventos
// -----------------------------------------------------------------------------------------
Route::prefix('/eventos')->group(function(){
    Route::get('', [EventosController::class, 'index']);  
    
    Route::get('/accesible', [EventosController::class, 'esAccesible']);
});

Route::prefix('/evento')->group(function(){
    Route::get('/{id}', [EventosController::class, 'show'])->where('id', '[0-9]+');
    Route::post('', [EventosController::class, 'store']);
    Route::delete('/{id}', [EventosController::class, 'destroy']);
    Route::put('/{id}', [EventosController::class, 'update']);

    // Users que participan en un evento
    Route::get('/{id}/users', [EventosController::class, '']);

    
});