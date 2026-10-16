<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::prefix('admin/home/slides')->group(base_path('routes/apis/hero_slide.php'));


Route::prefix('admin/home/regional')->group(base_path('routes/apis/regional.php'));

Route::prefix('media')->group(base_path('routes/apis/media.php'));

Route::prefix('admin/home/stats')->group(base_path('routes/apis/statistic.php'));


Route::prefix('admin/home/video')->group(base_path('routes/apis/video_content.php'));


Route::prefix('admin/insights')->group(base_path('routes/apis/insight.php'));


Route::prefix('admin/about-page')->group(base_path('routes/apis/about_page.php'));



Route::prefix('/contact')->group(base_path('routes/apis/contact.php'));


Route::prefix('/auth')->group(base_path('routes/apis/auth.php'));