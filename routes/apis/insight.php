<?php

use App\Http\Controllers\Apis\InsightController;
use Illuminate\Support\Facades\Route;





  Route::get('/', [
        InsightController::class,
        'index',
    ]);

    Route::get('/featured', [
        InsightController::class,
        'featured',
    ]);

    Route::get('/{id}', [
        InsightController::class,
        'show',
    ]);

    Route::post('/', [
        InsightController::class,
        'store',
    ]);
    Route::put('/{id}', [
        InsightController::class,
        'update',
    ]);
    Route::delete('/{id}', [
        InsightController::class,
        'destroy',
    ]);