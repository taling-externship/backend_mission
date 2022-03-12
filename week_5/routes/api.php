<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
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

// Article
Route::get('articles', [ArticleController::class, 'getArticles']); // 전체 조회
Route::post('article', [ArticleController::class, 'addArticle']); // 특정 데이터 추가
Route::put('articles', [ArticleController::class, 'update']); // 데이터 업로드
Route::delete('articles/{id}', [ArticleController::class, 'delete']); // 데이터 삭제
Route::get('articles/{slug_id}/{slug}', [ArticleController::class, 'getArticle']); // 특정 데이터 조회
