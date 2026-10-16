<?php

use App\Http\Controllers\Apis\StatisticController;
use Illuminate\Support\Facades\Route;



Route::get('/', [StatisticController::class, 'index']);

Route::get('/{id}', [StatisticController::class, 'show']);

Route::post('/', [StatisticController::class, 'upsert']);

Route::delete('/{id}', [StatisticController::class, 'destroy']);
