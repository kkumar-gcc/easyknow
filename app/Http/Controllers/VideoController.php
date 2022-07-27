<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tab = "newest";
        $topBlogs = Blog::where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();
        
        $topUsers = User::withCount('friendships')->orderByDesc('friendships_count')->limit(5)->get();
        $topTags = Tag::withCount(['blogs' => function ($q) {
            $q->where('status', '=', "posted");
        }])->orderByDesc('blogs_count')->limit(10)->get();
        $videos = Video::orderByDesc('created_at')->paginate(10);
        return view('video.index')->with([
            "videos"=>$videos,
            "tab" => $tab,
            "topUsers" => $topUsers,
            "topTags" =>$topTags,
            "topBlogs"=>$topBlogs
        ]);
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
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
