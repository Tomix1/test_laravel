<?php

use App\Http\Api\V1\Controllers\ProcurementController;

Route::prefix('v1')->group(function () {
    Route::get('procurement/optimal', [ProcurementController::class, 'optimal'])
         ->name('api.procurement.optimal');
});

