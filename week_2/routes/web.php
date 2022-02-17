<?php

use App\Http\Controllers\BoardController;
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

Route::get('/',  function (){
    return view('home');
});
Route::get('/boards', [BoardController::class, 'list'])->name('boards');

// [View]
Route::get('/boards/detail/{slug}', [BoardController::class, 'detail'])->name('boards.detail');
Route::get('/boards/edit/{id}', [BoardController::class, 'edit'])->name('boards.edit');
Route::get('/boards/create', [BoardController::class, 'create'])->name('boards.create');

// [Event]
Route::post('/boards/write', [BoardController::class, 'write'])->name('boards.write');
Route::post('/boards/update', [BoardController::class, 'update'])->name('boards.update');
Route::delete('/boards/delete/{id}', [BoardController::class, 'delete'])->name('boards.delete');
