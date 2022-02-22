<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller('App\\Http\\Controllers\\Auth\\ApiAuthController')->group(function () {
    Route::post('/v1/register', 'store');
    Route::post('/v1/login', 'login');
});

Route::resource('/v1/article', 'App\Http\Controllers\ArticleController')
    ->only(['index', 'show']);

Route::resource('/v1/article', 'App\Http\Controllers\ArticleController')
    ->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);

Route::resource('/v1/article/{article}/love', 'App\Http\Controllers\LoveController')
    ->only(['store', 'destroy']);
