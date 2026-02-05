<?php

use App\Http\Controllers\EntidadesController;
use Illuminate\Support\Facades\Route;


// Entidades
// -----------------------------------------------------------------------------------------
Route::prefix('/entidades')->group(function(){
    Route::get('', [EntidadesController::class, 'index']);   
});

Route::prefix('/entidad')->group(function(){
    Route::get('/{id}', [EntidadesController::class, 'show'])->where('id', '[0-9]+');
    Route::post('', [EntidadesController::class, 'store']);
    Route::delete('/{id}', [EntidadesController::class, 'destroy']);
    Route::put('/{id}', [EntidadesController::class, 'update']);
});