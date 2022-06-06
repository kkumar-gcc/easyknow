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
            $exitFriend = Friendship::where([
                ["user_id", "=", $userId],
                ["follower_id", "=", $followerId]
            ])->count();
            if ($exitFriend < 1) {

                $friendship = new Friendship();
                $friendship->user_id = $userId;
                $friendship->follower_id = $followerId;
                $friendship->status = 1;
                $friendship->save();

                $numberOfFollower = Friendship::where("user_id", "=", $userId)->count();
                return response()->json([
                    "success" => 'follower added successfully.',
                    "followers" => $numberOfFollower,
                    "user_id"=>$userId
                ]);
            } else {
                $numberOfFollower = Friendship::where("user_id", "=", $userId)->count();

                return response()->json([
                    "error" => 'you are already a follower.',
                    "followers" => $numberOfFollower,
                    "user_id"=>$userId
                ]);
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
        $userId = $request->get('user_id');
        $followerId = $request->get("follower_id");
        $exitFriend =  Friendship::where([
            ["user_id", "=", $userId],
            ["follower_id", "=", $followerId]
        ])->count();

        if ($exitFriend == 1) {

            Friendship::where([
                ["user_id", "=", $userId],
                ["follower_id", "=", $followerId]
            ])->delete();
            $numberOfFollower = Friendship::where("user_id", "=", $userId)->count();

            return response()->json([
                "success" => 'follower removed successfully.',
                "followers" => $numberOfFollower,
                "user_id"=>$userId,
            ]);
        } else {
            $numberOfFollower = Friendship::where("user_id", "=", $userId)->count();

            return response()->json([
                "error" => 'You haven\'t followed yet.',
                "followers" => $numberOfFollower,
                "user_id"=>$userId,
            ]);
        }
    }
}
