<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PrivateProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;
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
});

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('comment', [CommentController::class, 'store']);
    Route::post('reply/{id}', [CommentController::class, 'store']);
    Route::get("users/{id}/{username}", [PrivateProfileController::class, 'index']);

    Route::get("blog/create", [BlogController::class, 'create'])->name("blog.create");
    Route::middleware(['cors'])->group(function () {
        Route::post("blog/draft", [BlogController::class, 'draft'])->name("blog.draft");
        Route::put("blog/create", [BlogController::class, 'post']);
        Route::put("blog/update", [BlogController::class, 'update'])->name('blog.update');
        Route::delete("blog/{id}/delete", [BlogController::class, 'destroy']);
        Route::post("/follower/create",[FriendshipController::class,'store'])->name("follower.create");
        Route::delete("/follower/delete",[FriendshipController::class,'destroy'])->name("follower.delete");
        Route::post("/like/create",[LikeController::class,'store'])->name("like.create");
        Route::delete("/follower/delete",[FriendshipController::class,'destroy'])->name("follower.delete");
    });
});
Route::get("blogs", [BlogController::class, 'index']);
Route::get("blogs/{id}", [BlogController::class, 'show']);
Route::get("blogs/{id}/reading-mode", [BlogController::class, 'ndshow']);
Route::get("users/{id}/{username}/public", [PublicProfileController::class, 'index']);
