<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;


Route::prefix('v1')->group(function () {
    // Route::get('/prueba', function () {
    //     return "Ruta de prueba";
    // });


    // ROLES
    // -----------------------------------------------------------------------------------------
    Route::prefix('/roles')->group(function(){
        Route::get('', [RolesController::class, 'index']);
        Route::get('/nombre/{nombreRol}', [RolesController::class, 'nombre']);    
    });
    
    Route::prefix('/rol')->group(function(){
        Route::get('/{id}', [RolesController::class, 'show'])->where('id', '[0-9]+');

        Route::post('', [RolesController::class, 'store']);
        Route::delete('/{id}', [RolesController::class, 'destroy']);
        Route::put('/{id}', [RolesController::class, 'update']);
        Route::patch('/{id}', [RolesController::class, 'update']);
    });

});