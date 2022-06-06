<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogLikeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PrivateProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReplyLikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\TagController;
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
        Route::put("/follower/create", [FriendshipController::class, 'store'])->name("follower.create");
        Route::delete("/follower/delete", [FriendshipController::class, 'destroy'])->name("follower.delete");
        Route::put("/bloglike/create", [BlogLikeController::class, 'like'])->name("bloglike.create");
        Route::put("/blogdislike/create", [BlogLikeController::class, 'dislike'])->name("blogdislike.create");
        Route::put("/commentlike/create", [CommentLikeController::class, 'like'])->name("commentlike.create");
        Route::put("/commentdislike/create", [CommentLikeController::class, 'dislike'])->name("commentdislike.create");
        Route::put("/replylike/create", [ReplyLikeController::class, 'like'])->name("replylike.create");
        Route::put("/replydislike/create", [ReplyLikeController::class, 'dislike'])->name("replydislike.create");
        Route::put("/bookmark/create", [BookmarkController::class, 'store'])->name("bookmark.create");
        Route::put("/comment/create", [CommentController::class, 'store'])->name("comment.create");
        Route::put("/reply/create", [ReplyController::class, 'store'])->name("reply.create");
        Route::put("tag/create", [TagController::class, 'store'])->name('tag.create');
        Route::get("/example", function () {
            return view('example');
        });
        // Route::delete("/follower/delete",[FriendshipController::class,'destroy'])->name("follower.delete");
    });
});
Route::get("blogs", [BlogController::class, 'index']);
Route::get("blogs/{id}", [BlogController::class, 'show']);
Route::get("blogs/{id}/reading-mode", [BlogController::class, 'ndshow']);
Route::get("tags", [TagController::class, 'index']);
Route::get("tag-detail", [TagController::class, "detailCard"]);
Route::get("user-detail", [PublicProfileController::class, "detailCard"]);
Route::get("users/{id}/{username}/public", [PublicProfileController::class, 'index']);
Route::get("tags/search", [TagController::class, "search"])->name('tags.search');
Route::get("blogs/tagged/{title}", [BlogController::class, "tagSearch"]);
Route::get('/social-media-share', [SocialShareButtonsController::class, 'ShareWidget']);
Route::get('/search',[SearchController::class,'index']);
Route::get('/search/option/tags',[SearchController::class,'searchTag']);
Route::get('/search/option/users',[SearchController::class,'searchUser']);
Route::get('/search/option/blogs',[SearchController::class,'searchBlog']);
Route::get('/search/tags',[SearchController::class,'tag']);
Route::get('/search/users',[SearchController::class,'user']);
Route::get('/search/blogs',[SearchController::class,'blog']);
