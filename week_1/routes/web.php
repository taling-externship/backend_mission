<?php

use Illuminate\Support\Facades\Route;

Route::get('{main?}', 'App\Http\Controllers\MainController')->where('main', 'main');;
Route::resource('/article', 'App\Http\Controllers\ArticleController');
