<?php

use App\Http\Controllers\AplicacionesController;
use Illuminate\Support\Facades\Route;


// Aplicaciones
// -----------------------------------------------------------------------------------------
Route::prefix('/aplicaciones')->group(function(){
    Route::get('', [AplicacionesController::class, 'index']);   
});

Route::prefix('/aplicacion')->group(function(){
    Route::get('/{id}', [AplicacionesController::class, 'show'])->where('id', '[0-9]+');
    Route::post('', [AplicacionesController::class, 'store']);
    Route::delete('/{id}', [AplicacionesController::class, 'destroy']);
    Route::put('/{id}', [AplicacionesController::class, 'update']);
});