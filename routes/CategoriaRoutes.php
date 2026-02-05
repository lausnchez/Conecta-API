<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;


// CATEGORIAS
// -----------------------------------------------------------------------------------------
Route::prefix('/categorias')->group(function(){
    Route::get('', [CategoriasController::class, 'index']);   
});

Route::prefix('/categoria')->group(function(){
    Route::get('/{id}', [CategoriasController::class, 'show'])->where('id', '[0-9]+');
    Route::post('', [CategoriasController::class, 'store']);
    Route::delete('/{id}', [CategoriasController::class, 'destroy']);
    Route::put('/{id}', [CategoriasController::class, 'update']);
});