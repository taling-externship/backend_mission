<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/boards', [BoardController::class, 'list'])->name('boards');
// [laravel/ui React --auth]
Route::get('/boards', [App\Http\Controllers\HomeController::class, 'index']);

// [View]
Route::get('/boards/detail/{slug}', [BoardController::class, 'detail'])->name('boards.detail');
Route::get('/boards/edit/{id}', [BoardController::class, 'edit'])->name('boards.edit');
Route::get('/boards/create', [BoardController::class, 'create'])->name('boards.create');

// [Event]
Route::post('/boards/write', [BoardController::class, 'write'])->name('boards.write');
Route::post('/boards/update', [BoardController::class, 'update'])->name('boards.update');
Route::delete('/boards/delete/{id}', [BoardController::class, 'delete'])->name('boards.delete');

// 좋아요 : 싫어요 만들기