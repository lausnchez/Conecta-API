<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

Route::prefix('v1')->group(function () {
    // Rutas públicas sin autentificación
    Route::post('/registro', [AuthController::class, 'registro']);
    Route::post('/login', [AuthController::class, 'login']);

    //Rutas protegidas con Sanctum (dentro del grupo de la versión)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
        
        require __DIR__.'/UserRoutes.php';      // Rutas de Users
        require __DIR__.'/RolesRoutes.php';     // Rutas de Roles
        require __DIR__.'/TagsRoutes.php'; // Rutas de Tags
    });
});




Route::prefix('v1')->group(function () {
    Route::get('/prueba', function () {
        return "Ruta de prueba";
    });
});