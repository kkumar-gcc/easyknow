<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoLikeRequest;
use App\Http\Requests\UpdateVideoLikeRequest;
use App\Models\VideoLike;

class VideoLikeController extends Controller
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
     * @param  \App\Http\Requests\StoreVideoLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoLike  $videoLike
     * @return \Illuminate\Http\Response
     */
    public function show(VideoLike $videoLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoLike  $videoLike
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoLike $videoLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoLikeRequest  $request
     * @param  \App\Models\VideoLike  $videoLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoLikeRequest $request, VideoLike $videoLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoLike  $videoLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoLike $videoLike)
    {
        //
    }
}
