<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->tab == 'name') {
            $tags = Tag::withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->orderBy('title')->paginate(18);
        } else if ($request->tab == 'newest') {
            $tags = Tag::withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->orderByDesc('created_at')->paginate(18);
        } else  if ($request->tab == 'popular') {
            $tags = Tag::withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->orderByDesc('blogs_count')->paginate(18);
        } else {
            $tags = Tag::paginate(18);
        }
        $topUsers = User::withCount('friendships')->orderByDesc('friendships_count')->limit(5)->get();
       
        return view('tags.index')->with(["tags" => $tags, "topUsers" => $topUsers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $query = $request->get('query');

        $tags = Tag::query()->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->take(40)->get();

        return response()->json([
            "searched" => true,
            "tags" => $tags,
        ]);
    }
    public function detailCard(Request $request)
    {
        $tagId = $request->get('tagId');

        $tag = Tag::query()->where('id', 'LIKE', $tagId)
            ->withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->get();

        return response()->json([
            "success" => true,
            "tag" => $tag,
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        if ($request->get('title') != '') {
            $userId = $request->get('user_id');
            $title = strtolower($request->get('title'));
            $existTag = Tag::where('title', "=", $title)->count();
            if ($title == trim($title) && str_contains($title, ' ')) {
                return response()->json([
                    "error" => "tag shouldn't contain whitespace."
                ]);
            } else {
                if ($existTag < 1) {
                    $tag = new Tag();
                    $tag->title = $title;
                    $tag->user_id = $userId;
                    $tag->save();
                    return response()->json([
                        "success" => "tag successfully created."
                    ]);
                } else {
                    return response()->json([
                        "error" => "tag already exists."
                    ]);
                }
            }
        }
        return response()->json([
            "error" => "empty tag isn't allowed."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
