<?php

use App\Http\Controllers\Apis\ContactController;
use Illuminate\Support\Facades\Route;



Route::post('/', [ContactController::class, 'store'])->middleware(['validate.contact']);