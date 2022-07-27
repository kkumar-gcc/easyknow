<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePodcastRequest;
use App\Http\Requests\UpdatePodcastRequest;
use App\Models\Blog;
use App\Models\Podcast;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

;

class PodcastController extends Controller
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
        $podcasts = Podcast::orderByDesc('created_at')->paginate(10);
        return view('podcast.index')->with([
            "podcasts" => $podcasts,
            "tab" => $tab,
            "topUsers" => $topUsers,
            "topTags" => $topTags,
            "topBlogs" => $topBlogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view("podcast.create");
        } else {
            return view("auth.login")->with(["warning" => "You must be logged in to create Blog."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePodcastRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePodcastRequest $request)
    {
        $validation = $request->validate([
            // "image" => 'required|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "title" => 'required|min:10|max:200'
        ]);
        
        $podcast = new Podcast();
        $podcast->title = $request->get('title');
        $podcast->description = $request->get('description');
        $podcast->user_id = auth()->user()->id;
        $podcast->number_episode = 0;
        $saved = $podcast->save();
        if($saved){
            return redirect('podcasts/'.$podcast->id)->with([
                "podcast"=>$podcast,
                "success"=>"Podcast series successfully created. Add some episode in it."
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tab = "newest";
        $podcast = Podcast::where('id', "=", $id)->first();
        return view('podcast.show')->with([
            "podcast" => $podcast,
            "tab" => $tab,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function edit(Podcast $podcast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePodcastRequest  $request
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePodcastRequest $request, Podcast $podcast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
        //
    }
}
