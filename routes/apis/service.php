<?php

use App\Http\Controllers\Apis\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ServiceController::class, 'index']);

// Must be declared before '/{service}' so "reorder" is never read as a slug.
Route::post('/reorder', [ServiceController::class, 'reorder']);

Route::get('/{service}', [ServiceController::class, 'show']);

Route::post('/', [ServiceController::class, 'store']);
Route::put('/{id}', [ServiceController::class, 'update'])->whereNumber('id');
Route::delete('/{id}', [ServiceController::class, 'destroy'])->whereNumber('id');
