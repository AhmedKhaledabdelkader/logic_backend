<?php

use App\Http\Controllers\Apis\HeroSlideController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HeroSlideController::class, 'index']);

Route::get('/{id}', [HeroSlideController::class, 'show']);

Route::post('/', [HeroSlideController::class, 'upsert']);

Route::delete('/{id}', [HeroSlideController::class, 'destroy']);
