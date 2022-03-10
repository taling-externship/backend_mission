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

Route::resource('/article', 'App\Http\Controllers\ArticleController')
    ->except(['create', 'edit']);

Route::resource('/article/{article}/love', 'App\Http\Controllers\LoveController')
    ->middleware('auth:sanctum')->only(['store', 'destroy']);

require __DIR__ . '/auth.php';

Route::controller('App\\Http\\Controllers\\Auth\\ApiAuthController')->group(function () {
    Route::post('/register', 'store');
    Route::post('/login', 'login');
});

require __DIR__ . '/attachment.php';

