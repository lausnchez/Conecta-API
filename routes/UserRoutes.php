<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;


Route::prefix('v1')->group(function () {
    // Route::get('/prueba', function () {
    //     return "Ruta de prueba";
    // });


    // USERS
    // -----------------------------------------------------------------------------------------
    Route::prefix('/users')->group(function(){
        Route::get('', [UserController::class, 'index']);
        Route::get('/activos', [UserController::class, 'activos']);
        Route::get('/inactivos', [UserController::class, 'inactivos']);
        Route::get('/empresas', [UserController::class, 'empresas']);
        Route::get('/no-empresas', [UserController::class, 'no_empresas']);
        Route::get('/familiares', [UserController::class, 'familiares']);
        Route::get('/no-familiares', [UserController::class, 'no_familiares']);
        Route::get('/admins', [UserController::class, 'admins']);
        Route::get('/developers', [UserController::class, 'developers']);
        Route::get('/general-users', [UserController::class, 'users']);
        Route::get('/username/{username}', [UserController::class, 'username']);
        Route::get('/search/{busqueda}', [UserController::class, 'nombreCompleto']);        
    });
    
    Route::prefix('/user')->group(function(){
        Route::get('/{id}', [UserController::class, 'show'])->where('id', '[0-9]+');

        Route::post('', [UserController::class, 'store']);
        Route::delete('/{id}', [UserController::class, 'destroy']);

        Route::put('/{id}', [UserController::class, 'update']);
        Route::patch('/{id}', [UserController::class, 'update']);

        // Ruta de cambiar contraseña, rol, porcentaje de discapacidad
    });

});