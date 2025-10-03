<?php

use App\Http\Api\Controllers\AuthorController;
use App\Http\Api\Controllers\SongController;

Route::prefix('authors')->group(function (){
    Route::get('/{author}', [AuthorController::class, 'show']);
    Route::get('/', [AuthorController::class, 'index']);
    Route::post('/', [AuthorController::class, 'store']);
    Route::put('/{author}', [AuthorController::class, 'update']);
    Route::delete('/{author}', [AuthorController::class, 'delete']);
});

Route::prefix('songs')->group(function (){
    Route::get('/{song}', [SongController::class, 'show']);
    Route::get('/', [SongController::class, 'index']);
    Route::post('/', [SongController::class, 'store']);
    Route::put('/{song}', [SongController::class, 'update']);
    Route::delete('/{song}', [SongController::class, 'delete']);
});
