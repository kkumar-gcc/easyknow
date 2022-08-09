<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFriendshipRequest;
use App\Http\Requests\UpdateFriendshipRequest;
use App\Models\Friendship;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FriendshipController extends Controller
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
     * @param  \App\Http\Requests\StoreFriendshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFriendshipRequest $request)
    {
        $userId = $request->get('user_id');
        if ($userId != auth()->user()->id) {
            $followerId = $request->get("follower_id");
            $existFriend = Friendship::where([
                ["following_id", "=", $userId],
                ["follower_id", "=", $followerId]
            ]);
            if ($existFriend->count() < 1) {

                $friendship = new Friendship();
                $friendship->following_id = $userId;
                $friendship->follower_id = $followerId;
                $friendship->status = 1;
                $friendship->save();
                return response()->json([
                    "follow" => 'follower added successfully.',
                    "user_id" => $userId
                ]);
            } else {
                $deleted = $existFriend->delete();
                if ($deleted) {
                    return response()->json([
                        "unfollow" => 'unfollowed successfully',
                        "user_id" => $userId
                    ]);
                } else {
                    return response()->json([
                        "error" => 'something goes wrong.',
                        "user_id" => $userId
                    ]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function show(Friendship $friendship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function edit(Friendship $friendship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFriendshipRequest  $request
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFriendshipRequest $request, Friendship $friendship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }
}
