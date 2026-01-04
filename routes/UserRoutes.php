<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;


Route::prefix('api/v1')->group(function () {
    // Route::get('/prueba', function () {
    //     return "Ruta de prueba";
    // });
    
    // URL BASE
    $base_url_users = '/users';

    Route::get($base_url_users, [UserController::class, 'index']);
    Route::get($base_url_users.'/activos', [UserController::class, 'activos']);
    Route::get($base_url_users.'/inactivos', [UserController::class, 'inactivos']);
    Route::get($base_url_users.'/empresas', [UserController::class, 'empresas']);
    Route::get($base_url_users.'/no-empresas', [UserController::class, 'no_empresas']);
    Route::get($base_url_users.'/familiares', [UserController::class, 'familiares']);
    Route::get($base_url_users.'/no-familiares', [UserController::class, 'no_familiares']);
    Route::get($base_url_users.'/admins', [UserController::class, 'admins']);
    Route::get($base_url_users.'/developers', [UserController::class, 'developers']);
    Route::get($base_url_users.'/general-users', [UserController::class, 'users']);
    
    Route::get($base_url_users.'/username/{username}', [UserController::class, 'username']);
    Route::get($base_url_users.'/{id}', [UserController::class, 'show']);
    // Buscar por nombre
});