<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoViewRequest;
use App\Http\Requests\UpdateVideoViewRequest;
use App\Models\VideoView;

class VideoViewController extends Controller
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
     * @param  \App\Http\Requests\StoreVideoViewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoView  $videoView
     * @return \Illuminate\Http\Response
     */
    public function show(VideoView $videoView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoView  $videoView
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoView $videoView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoViewRequest  $request
     * @param  \App\Models\VideoView  $videoView
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoViewRequest $request, VideoView $videoView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoView  $videoView
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoView $videoView)
    {
        //
    }
}
