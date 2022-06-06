<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogLikeRequest;
use App\Http\Requests\UpdateBlogLikeRequest;
use App\Models\BlogLike;

class BlogLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function like(StoreBlogLikeRequest $request)
    {
        $userId = $request->get('userId');
        $blogId = $request->get('blogId');
        $exitLike = BlogLike::where([
            ['user_id', '=', $userId],
            ['blog_id', '=', $blogId]
        ])->count();
        if ($exitLike < 1) {
            $like = new BlogLike();
            $like->user_id = $userId;
            $like->blog_id = $blogId;
            $like->status = 1;
            $like->save();
            $allLike = BlogLike::where([
                ['blog_id', '=', $blogId],
                ["status", "=", 1]
            ])->count();
            $allDislike = BlogLike::where([
                ['blog_id', '=', $blogId],
                ["status", "=", 0]
            ])->count();
            return response()->json([
                "success" => "liked",
                "created" => true,
                "likes" => $allLike,
                "dislikes" => $allDislike
            ]);
        } else {
            $blogLike = BlogLike::where([
                ['user_id', '=', $userId],
                ['blog_id', '=', $blogId]
            ])->first();
            if ($blogLike->status == 1) {
                BlogLike::where([
                    ['user_id', '=', $userId],
                    ['blog_id', '=', $blogId]
                ])->delete();

                $allLike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like removed",
                    "removed" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            } else if ($blogLike->status == 0) {
                $blogLike->status = 1;
                $blogLike->save();
                $allLike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like updated",
                    "updated" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            }
        }
    }
    public function dislike(StoreBlogLikeRequest $request)
    {
        $userId = $request->get('userId');
        $blogId = $request->get('blogId');
        $exitLike = BlogLike::where([
            ['user_id', '=', $userId],
            ['blog_id', '=', $blogId]
        ])->count();


        if ($exitLike < 1) {
            $dislike = new BlogLike();
            $dislike->user_id = $userId;
            $dislike->blog_id = $blogId;
            $dislike->status = 0;
            $dislike->save();
            $allLike = BlogLike::where([
                ['blog_id', '=', $blogId],
                ["status", "=", 1]
            ])->count();
            $allDislike = BlogLike::where([
                ['blog_id', '=', $blogId],
                ["status", "=", 0]
            ])->count();
            return response()->json([
                "success" => "disliked",
                "created" => true,
                "likes" => $allLike,
                "dislikes" => $allDislike
            ]);
        } else {
            $blogLike = BlogLike::where([
                ['user_id', '=', $userId],
                ['blog_id', '=', $blogId]
            ])->first();
            if ($blogLike->status == 0) {
                BlogLike::where([
                    ['user_id', '=', $userId],
                    ['blog_id', '=', $blogId]
                ])->delete();

                $allLike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like removed",
                    "removed" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            } else if ($blogLike->status == 1) {
                $blogLike->status = 0;
                $blogLike->save();
                $allLike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = BlogLike::where([
                    ['blog_id', '=', $blogId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like updated",
                    "updated" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function show(BlogLike $blogLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogLike $blogLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogLikeRequest  $request
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogLikeRequest $request, BlogLike $blogLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogLike  $blogLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogLike $blogLike)
    {
        //
    }
}
