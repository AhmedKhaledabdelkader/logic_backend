<?php

use App\Http\Controllers\Apis\WorkStepController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WorkStepController::class, 'index']);

// Declared before the {id} routes so "reorder" is never read as an id.
Route::post('/reorder', [WorkStepController::class, 'reorder']);

Route::get('/{id}', [WorkStepController::class, 'show'])->whereNumber('id');
Route::post('/', [WorkStepController::class, 'store']);
Route::put('/{id}', [WorkStepController::class, 'update'])->whereNumber('id');
Route::delete('/{id}', [WorkStepController::class, 'destroy'])->whereNumber('id');
