<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Post;

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

Route::get("/post/new", function () {
	return view("new");
});

Route::post("/post/new", function (Request $request) {
	// error_log($request->input("post-body"));

	$postBody = $request->input("post-body");

	return view("new");
});

Route::get("/", function () {
	$myData = array("a", "b", "c");

	return view("welcome", ["myData" => $myData]);
});

Route::get("/post/{postId}", function () {
	return view("detail");
});

Route::get("/dashboard", function () {
	return view("dashboard");
})->middleware(["auth"])->name("dashboard");

require __DIR__."/auth.php";
