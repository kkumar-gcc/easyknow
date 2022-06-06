<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentLikeRequest;
use App\Http\Requests\UpdateCommentLikeRequest;
use App\Models\CommentLike;

class CommentLikeController extends Controller
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



    public function like(StoreCommentLikeRequest $request)
    {
        $userId = $request->get('userId');
        $commentId = $request->get('commentId');
        $exitLike = CommentLike::where([
            ['user_id', '=', $userId],
            ['comment_id', '=', $commentId]
        ])->count();
        if ($exitLike < 1) {
            $like = new CommentLike();
            $like->user_id = $userId;
            $like->comment_id = $commentId;
            $like->status = 1;
            $like->save();
            $allLike = CommentLike::where([
                ['comment_id', '=', $commentId],
                ["status", "=", 1]
            ])->count();
            $allDislike = CommentLike::where([
                ['comment_id', '=', $commentId],
                ["status", "=", 0]
            ])->count();
            return response()->json([
                "success" => "liked",
                "created" => true,
                "likes" => $allLike,
                "dislikes" => $allDislike
            ]);
        } else {
            $commentLike = CommentLike::where([
                ['user_id', '=', $userId],
                ['comment_id', '=', $commentId]
            ])->first();
            if ($commentLike->status == 1) {
               $commentLike->delete();
                
                $allLike = CommentLike::where([
                    ['comment_id', '=', $commentId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = CommentLike::where([
                    ['comment_id', '=', $commentId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like removed",
                    "removed" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            } else if ($commentLike->status == 0) {
                $commentLike->status = 1;
                $commentLike->save();
                $allLike = CommentLike::where([
                    ['comment_id', '=', $commentId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = CommentLike::where([
                    ['comment_id', '=', $commentId],
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
    public function dislike(StoreCommentLikeRequest $request)
    {
        $userId = $request->get('userId');
        $commentId = $request->get('commentId');

        $existLike = CommentLike::where([
            ['user_id', '=', $userId],
            ['comment_id', '=', $commentId]
        ])->count();
        
        if ($existLike < 1) {
            $dislike = new CommentLike();
            $dislike->user_id = $userId;
            $dislike->comment_id = $commentId;
            $dislike->status = 0;
            $dislike->save();
            $allLike = CommentLike::where([
                ['comment_id', '=', $commentId],
                ["status", "=", 1]
            ])->count();
            $allDislike = CommentLike::where([
                ['comment_id', '=', $commentId],
                ["status", "=", 0]
            ])->count();
            return response()->json([
                "success" => "disliked",
                "created" => true,
                "likes" => $allLike,
                "dislikes" => $allDislike
            ]);
        } else {
            $commentLike = CommentLike::where([
                ['user_id', '=', $userId],
                ['comment_id', '=', $commentId]
            ])->first();
            if ($commentLike->status == 0) {
               $commentLike->delete();
                
                $allLike =CommentLike::where([
                    ['comment_id', '=', $commentId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = CommentLike::where([
                    ['comment_id', '=', $commentId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like removed",
                    "removed" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            } else if ($commentLike->status == 1) {
                $commentLike->status = 0;
                $commentLike->save();
                $allLike = CommentLike::where([
                    ['comment_id', '=', $commentId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = CommentLike::where([
                    ['comment_id', '=', $commentId],
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function show(CommentLike $commentLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentLike $commentLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentLikeRequest  $request
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentLikeRequest $request, CommentLike $commentLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentLike  $commentLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentLike $commentLike)
    {
        //
    }
}
