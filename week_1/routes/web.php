<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('boards/search', SearchController::class)->name('boards.search');

Route::resource('boards', BoardController::class);

Route::get('/abc', function () {
    return view('abc')->with(['age' => 10]);
});