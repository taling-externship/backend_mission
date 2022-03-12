<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{main?}', 'App\Http\Controllers\MainController')->where('main', 'main');;

Route::resource('/article', 'App\Http\Controllers\ArticleController');
Route::resource('/article/{article}/love', 'App\Http\Controllers\LoveController')
    ->only(['store', 'destroy']);

require __DIR__ . '/auth.php';

require __DIR__ . '/attachment.php';

Route::get('/info', fn() => phpinfo());
