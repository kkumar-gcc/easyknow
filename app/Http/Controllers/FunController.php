<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFunRequest;
use App\Http\Requests\UpdateFunRequest;
use App\Models\Blog;
use App\Models\Fun;
use App\Models\Tag;
use App\Models\User;

class FunController extends Controller
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
        $videos = Fun::where("status", "=", "posted")->get();
        return view('videos.index')->with([
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
     * @param  \App\Http\Requests\StoreFunRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFunRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fun  $fun
     * @return \Illuminate\Http\Response
     */
    public function show(Fun $fun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fun  $fun
     * @return \Illuminate\Http\Response
     */
    public function edit(Fun $fun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFunRequest  $request
     * @param  \App\Models\Fun  $fun
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFunRequest $request, Fun $fun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fun  $fun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fun $fun)
    {
        //
    }
}
