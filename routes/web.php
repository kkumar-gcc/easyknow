<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogLikeController;
use App\Http\Controllers\BlogPinController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PrivateProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReplyLikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VedioController;
use App\Http\Controllers\VideoController;
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

Route::group(['middleware' => 'HtmlMinifier'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::post('/comment', [CommentController::class, 'store']);
        Route::post('/reply/{id}', [CommentController::class, 'store']);
        Route::get("/settings", [PrivateProfileController::class, 'index']);
        Route::put("/settings/social-links", [PrivateProfileController::class, 'social']);
        Route::post("/profile/update", [PrivateProfileController::class, 'store']);
        Route::put("/user/password/update", [UserController::class, 'resetPassword']);

        Route::get("blog/create", [BlogController::class, 'create'])->name("blog.create");
        Route::middleware(['cors'])->group(function () {
            Route::post("blog/draft", [BlogController::class, 'draft'])->name("blog.draft");
            Route::put("blog/create", [BlogController::class, 'post']);
            Route::get("/blogs/edit/{title}", [BlogController::class, 'edit']);
            Route::put("/blogs/edit", [BlogController::class, 'editStore'])->name('blogs.edit');
            Route::get("/blogs/manage/{title}", [BlogController::class, 'manage']);
            Route::put("/blogs/manage/seo", [BlogController::class, 'seo'])->name('blogs.manage.seo');
            Route::put("/blogs/manage", [BlogController::class, 'manageStore'])->name('blogs.manage');
            Route::get("/blogs/stats/{title}", [BlogController::class, 'stats']);
            Route::get("blogs/{id}/statics", [BlogController::class, 'statics']);
            Route::get("/drafts/{id}", [PrivateProfileController::class, 'draft']);
            Route::delete("blog/{id}/delete", [BlogController::class, 'destroy']);
            Route::put("/follow", [FriendshipController::class, 'store'])->name("follow");
            Route::put("/bloglike/create", [BlogLikeController::class, 'like'])->name("bloglike.create");
            Route::put("/blogdislike/create", [BlogLikeController::class, 'dislike'])->name("blogdislike.create");
            Route::put("/commentlike/create", [CommentLikeController::class, 'like'])->name("commentlike.create");
            Route::put("/commentdislike/create", [CommentLikeController::class, 'dislike'])->name("commentdislike.create");
            Route::put("/replylike/create", [ReplyLikeController::class, 'like'])->name("replylike.create");
            Route::put("/replydislike/create", [ReplyLikeController::class, 'dislike'])->name("replydislike.create");
            Route::put("/bookmark/create", [BookmarkController::class, 'store'])->name("bookmark.create");
            Route::put("/blogpin/create", [BlogPinController::class, 'store'])->name("blogpin.create");
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
    Route::get("/topcontent", [SearchController::class, 'topContent']);
    Route::get("blogs/{title}", [BlogController::class, 'show']);
    Route::get("blogs/{id}/reading-mode", [BlogController::class, 'ndshow']);
    Route::get("tags", [TagController::class, 'index']);
    Route::get("tag-detail", [TagController::class, "detailCard"]);
    Route::get("blog-detail", [BlogController::class, "detailCard"]);
    Route::get("user-detail", [PublicProfileController::class, "detailCard"]);
    Route::get("users/{username}", [PublicProfileController::class, 'index']);
    Route::get("tags/search", [TagController::class, "search"])->name('tags.search');
    Route::get("blogs/tagged/{title}", [BlogController::class, "tagSearch"]);
    Route::get('/social-media-share', [SocialShareButtonsController::class, 'ShareWidget']);
    Route::get('/search', [SearchController::class, 'index']);
    Route::get('/search/option/tags', [SearchController::class, 'searchTag']);
    Route::get('/search/option/users', [SearchController::class, 'searchUser']);
    Route::get('/search/option/blogs', [SearchController::class, 'searchBlog']);
    Route::get('/search/tags', [SearchController::class, 'tag']);
    Route::get('/search/users', [SearchController::class, 'user']);
    Route::get('/search/blogs', [SearchController::class, 'blog']);
    Route::get("/videos", [VideoController::class, 'index']);
    Route::get("/podcasts", [PodcastController::class, 'index']);
    Route::get("/podcasts/{id}", [PodcastController::class, 'show']);
    Route::get("/podcast/create", [PodcastController::class, 'create']);
    Route::put("/podcastcreate", [PodcastController::class, 'store']);
    Route::get("/podcasts/{id}/episodes/{ep}", [EpisodeController::class, 'show']);
    Route::get("/podcasts/{id}/episode/create", [EpisodeController::class, 'create']);
    Route::put("/podcasts/{id}/episode/create", [EpisodeController::class, 'store']);
    //test route
    Route::get("/test",[TestController::class,'test']);
    Route::get("/test/login",[TestController::class,'login']);
    Route::get("/test/register",[TestController::class,'register']);
    Route::get("/test/feature-list",[TestController::class,'feature']);

   
});
