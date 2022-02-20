<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
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
    return view('home');
})->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index')->name('posts');
        Route::get('/posts/{post}', 'show')->name('posts.show');
        Route::post('/posts', 'store');
        Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    });

    Route::controller(PostLikeController::class)->group(function () {
        Route::post('/posts/{post}/likes','store')->name('posts.likes');
        Route::delete('/posts/{post}/likes', 'destroy')->name('posts.likes');
    });

    Route::controller(LogoutController::class)->group(function () {
        Route::post('/logout', 'store')->name('logout');
    });
});

Route::controller(UserPostController::class)->group(function () {
    Route::get('/users/{user:username}/posts', 'index')->name('users.posts');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'store');
});
