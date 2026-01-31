<?php

use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;


// TAGS
// -----------------------------------------------------------------------------------------
Route::prefix('/tags')->group(function(){
    Route::get('', [TagsController::class, 'index']);   
});

Route::prefix('/tag')->group(function(){
    Route::get('/{id}', [TagsController::class, 'show'])->where('id', '[0-9]+');
    Route::post('', [TagsController::class, 'store']);
    Route::delete('/{id}', [TagsController::class, 'destroy']);
    Route::put('/{id}', [TagsController::class, 'update']);
    // Route::patch('/{id}', [TagsController::class, 'update']);
});