<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

Route::prefix('v1')->group(function () {
    Route::post('/registro', [AuthController::class, 'registro']);  // <- No funciona
    Route::post('/login', [AuthController::class, 'login']);

    //Rutas protegidas con Sanctum (dentro del grupo de la versión)
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    /*... Mas rutas que requieran autenticación como obtener los post del usuario
    logado, crear un post, etc.*/
    });
});

require __DIR__.'/UserRoutes.php';   // Rutas de Users




Route::prefix('v1')->group(function () {
    Route::get('/prueba', function () {
        return "Ruta de prueba";
    });
});