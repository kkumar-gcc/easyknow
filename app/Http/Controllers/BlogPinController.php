<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPinRequest;
use App\Http\Requests\UpdateBlogPinRequest;
use App\Models\Blog;
use App\Models\BlogPin;

class BlogPinController extends Controller
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
     * @param  \App\Http\Requests\StoreBlogPinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPinRequest $request)
    {
        $userId = $request->get('user_id');
        $blogId = $request->get('blog_id');
        $exitPin = BlogPin::where([
            ['user_id', '=', $userId],
            ['blog_id', '=', $blogId]
        ])->count();
        $blog = Blog::find($blogId);
        if ($exitPin < 1) {
            $pin = new BlogPin();
            $pin->user_id = $userId;
            $pin->blog_id = $blogId;
            $pin->save();
            $blog->pinned = true;
            $blog->save();
            $pins = BlogPin::where("user_id", "=", auth()->user()->id)->get();
            $blogs = Blog::where("user_id", "=", $userId)->where([['status', '=', 'posted'],["pinned","=",false]])->paginate(5);
            $pinPage = view("profile.private.partials.pinTab")->with([
                "pins" => $pins,
                "blogs" => $blogs,
            ])->render();
            return response()->json([
                "success" => "Successfully Pinned",
                "page" => $pinPage,
                "created" => true,
            ]);
        } else {
            $pin = BlogPin::where([
                ['user_id', '=', $userId],
                ['blog_id', '=', $blogId]
            ])->first();
            $pin->delete();
            $blog->pinned = false;
            $blog->save();
            $pins = BlogPin::where("user_id", "=", auth()->user()->id)->get();
            $blogs = Blog::where("user_id", "=", $userId)->where([['status', '=', 'posted'],["pinned","=",false]])->paginate(5);
            $pinPage = view("profile.private.partials.pinTab")->with([
                "pins" => $pins,
                "blogs" => $blogs
            ])->render();
            return response()->json([
                "success" => "Removed from your Pins",
                "removed" => true,
                "page" => $pinPage,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPin $blogPin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPin $blogPin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogPinRequest  $request
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogPinRequest $request, BlogPin $blogPin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPin  $blogPin
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPin $blogPin)
    {
        //
    }
}
