<?php

use App\Http\Controllers\Apis\AboutPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| About Page routes
|--------------------------------------------------------------------------
|
| Add these alongside your existing Insight routes in routes/api.php.
| Singleton resource — only GET (show) and PUT (update) exist, since
| there's exactly one About page row and nothing to list/store/destroy.
|
| The PUT route must be hit from the frontend as a spoofed POST
| (_method=PUT in the FormData body) whenever story_image is included,
| for the same PHP multipart-parsing reason as the Insights update route.
*/
Route::get('/', [AboutPageController::class, 'show']);
Route::put('/', [AboutPageController::class, 'update']);