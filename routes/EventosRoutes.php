<?php

use App\Http\Controllers\EventosController;
use Illuminate\Support\Facades\Route;
use Laravel\Prompts\Concerns\Events;

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

    Route::get('/{id}/participantes', [EventosController::class, 'usersApuntados']);
    Route::post('/{id}/apuntar', [EventosController::class, 'apuntarUser']);
    Route::delete('/{id}/desapuntar', [EventosController::class, 'desapuntarUser']);
});