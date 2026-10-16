<?php

use App\Http\Controllers\Apis\HeroSlideController;
use App\Http\Controllers\Apis\RegionalController;
use Illuminate\Support\Facades\Route;



Route::get('/', [RegionalController::class, 'index']);

Route::get('/{id}', [RegionalController::class, 'show']);

Route::post('/', [RegionalController::class, 'upsert']);

Route::delete('/{id}', [RegionalController::class, 'destroy']);
