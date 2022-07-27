<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateEpisodeRequest;
use App\Http\Traits\AllTrait;
use App\Models\Episode;
use App\Models\Podcast;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use AllTrait;
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tab = "newest";
        $podcast = Podcast::where('id', "=", $id)->first();
        return view('podcast.episode.create')->with([
            "podcast" => $podcast,
            "tab" => $tab,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEpisodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEpisodeRequest $request,$id)
    {
        $validation = $request->validate([
            "image" => 'required|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'audio'=>'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            "title" => 'required|min:10|max:200',

        ]);
       
        $podcast = Podcast::where('id','=',$id)->first();
        $episode = new Episode(); 
        if ($request->hasFile('image')) {
            $image = $this->uploads($request->file('image'));
            $episode->image = $image['filePath'];
        }
        $episode->title = $request->get('title');
        $episode->description = $request->get('description');
        $episode->podcast_id = $id;
        $episode->link = 'https://cdn.simplecast.com/audio/fd7dca0e-5e82-4d04-b65f-c0aa44661798/episodes/2abe71b3-e7f5-46e1-b0ea-ef8328738b8f/audio/a4975c4c-08a2-42b9-bec1-d73604249f3f/default_tc.mp3?aid=embed';
        $episode->serial_number = $podcast->episodes->count()+1;
        $saved = $episode->save();
        if($saved){
            return redirect('podcasts/'.$id.'/episodes/'.$episode->id)->with([
                "success"=>"Podcast series successfully created. Add some episode in it."
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show($id,$ep)
    {
        $tab = "newest";
        $podcast = Podcast::where('id', "=", $id)->first();
        $currentEpisode = Episode::where('id','=',$ep)->first();
        return view('podcast.episode.show')->with([
            "podcast" => $podcast,
            "currentEp"=>$currentEpisode,
            "tab" => $tab,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEpisodeRequest  $request
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEpisodeRequest $request, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
