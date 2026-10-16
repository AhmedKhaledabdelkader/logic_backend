<?php


use App\Http\Controllers\Apis\VideoContentController;
use Illuminate\Support\Facades\Route;



Route::get('/', [VideoContentController::class, 'show']);


Route::post('/', [VideoContentController::class, 'upsert']);
