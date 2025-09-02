<?php

use App\Http\Controllers\CarController;

Route::prefix('cars')
     ->group(function () {
         Route::get('/available', [CarController::class, 'available']);
     });
