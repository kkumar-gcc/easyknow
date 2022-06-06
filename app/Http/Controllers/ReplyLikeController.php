<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyLikeRequest;
use App\Http\Requests\UpdateReplyLikeRequest;
use App\Models\ReplyLike;

class ReplyLikeController extends Controller
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



    public function like(StoreReplyLikeRequest $request)
    {
        $userId = $request->get('userId');
        $replyId = $request->get('replyId');
        $exitLike = ReplyLike::where([
            ['user_id', '=', $userId],
            ['reply_id', '=', $replyId]
        ])->count();
        if ($exitLike < 1) {
            $like = new ReplyLike();
            $like->user_id = $userId;
            $like->reply_id = $replyId;
            $like->status = 1;
            $like->save();
            $allLike = ReplyLike::where([
                ['reply_id', '=', $replyId],
                ["status", "=", 1]
            ])->count();
            $allDislike = ReplyLike::where([
                ['reply_id', '=', $replyId],
                ["status", "=", 0]
            ])->count();
            return response()->json([
                "success" => "liked",
                "created" => true,
                "likes" => $allLike,
                "dislikes" => $allDislike
            ]);
        } else {
            $replyLike = ReplyLike::where([
                ['user_id', '=', $userId],
                ['reply_id', '=', $replyId]
            ])->first();
            if ($replyLike->status == 1) {
               $replyLike->delete();
                
                $allLike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like removed",
                    "removed" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            } else if ($replyLike->status == 0) {
                $replyLike->status = 1;
                $replyLike->save();
                $allLike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
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
    public function dislike(StoreReplyLikeRequest $request)
    {
        $userId = $request->get('userId');
        $replyId = $request->get('replyId');

        $existLike = ReplyLike::where([
            ['user_id', '=', $userId],
            ['reply_id', '=', $replyId]
        ])->count();
        
        if ($existLike < 1) {
            $dislike = new ReplyLike();
            $dislike->user_id = $userId;
            $dislike->reply_id = $replyId;
            $dislike->status = 0;
            $dislike->save();
            $allLike = ReplyLike::where([
                ['reply_id', '=', $replyId],
                ["status", "=", 1]
            ])->count();
            $allDislike = ReplyLike::where([
                ['reply_id', '=', $replyId],
                ["status", "=", 0]
            ])->count();
            return response()->json([
                "success" => "disliked",
                "created" => true,
                "likes" => $allLike,
                "dislikes" => $allDislike
            ]);
        } else {
            $replyLike = ReplyLike::where([
                ['user_id', '=', $userId],
                ['reply_id', '=', $replyId]
            ])->first();
            if ($replyLike->status == 0) {
                $replyLike->delete();
                
                $allLike =ReplyLike::where([
                    ['reply_id', '=', $replyId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
                    ["status", "=", 0]
                ])->count();
                return response()->json([
                    "success" => "like removed",
                    "removed" => true,
                    "likes" => $allLike,
                    "dislikes" => $allDislike
                ]);
            } else if ($replyLike->status == 1) {
                $replyLike->status = 0;
                $replyLike->save();
                $allLike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
                    ["status", "=", 1]
                ])->count();
                $allDislike = ReplyLike::where([
                    ['reply_id', '=', $replyId],
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
     * @param  \App\Http\Requests\StoreReplyLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function show(ReplyLike $replyLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function edit(ReplyLike $replyLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReplyLikeRequest  $request
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyLikeRequest $request, ReplyLike $replyLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReplyLike  $replyLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReplyLike $replyLike)
    {
        //
    }
}
