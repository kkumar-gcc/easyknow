<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where("status", "=", "posted")->paginate(10);

        return view("blogs.index")->with([
            "blogs" => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blogs.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function draft(Request $request)
    {
        $blogId = $request->get('blogId');
        $blogTitle = $request->get('blogTitle');
        $blogDescription = $request->get('blogDescription');
        if ($blogId != '') {

            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->save();
        } else {
            $blog = new Blog();
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->status = "drafted";
            $blog->user_id = auth()->user()->id;
            $blog->save();
            $blogId = $blog->id;
        }

        return response()->json([
            "success" => 'post created successfully',
            "blogId" => $blogId
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $blog = Blog::find($id);
        $friendship = NULL; 
        if ($blog) {
            if ($blog->status == "posted") {
                if(Auth::check()){
                    $friendship = Friendship::where([
                    ["user_id", "=", $blog->user_id],
                    ["follower_id", "=", auth()->user()->id]
                ])->count();
                }
                
                $comments = Comment::where("blog_id", "=", $id)->paginate(5)->fragment('comments');
                return view("blogs.show")->with([
                    "blog" => $blog,
                    "comments" => $comments,
                    "friendship" => $friendship
                ]);
            }
        }
        return view("error");
    }
    public function ndshow($id)
    {

        $blog = Blog::find($id);
        $friendship = NULL; 
        if ($blog) {
            if ($blog->status == "posted") {
                if(Auth::check()){
                    $friendship = Friendship::where([
                    ["user_id", "=", $blog->user_id],
                    ["follower_id", "=", auth()->user()->id]
                ])->count();
                }
                
                $comments = Comment::where("blog_id", "=", $id)->paginate(5)->fragment('comments');
                return view("blogs.ndshow")->with([
                    "blog" => $blog,
                    "comments" => $comments,
                    "friendship" => $friendship
                ]);
            }
        }
        return view("error");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {

        $blogId = $request->get('blog_id');
        $blogTitle = $request->get('title');
        $blogDescription = $request->get('description');
        $blog = Blog::find($blogId);
        $blog->title = $blogTitle;
        $blog->description = $blogDescription;
        $blog->status = "posted";
        $blog->save();
        return redirect()->to("blogs/" . $blogId)->with([
            "blog" => $blog,
            "success" => 'blog created successfully.'
        ]);
    }
    public function update(Request $request)
    {
        if (auth()->user()->id == $request->get('user_id')) {
            $blogId = $request->get('blog_id');
            $blogTitle = $request->get('title');
            $blogDescription = $request->get('description');
            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->status = "posted";
            $blog->save();
            $comments = Comment::where("blog_id", "=", $blogId)->paginate(5)->fragment('comments');

            return redirect()->to("blogs/" . $blogId)->with([
                "blog" => $blog,
                "comments" => $comments,
                "success" => 'blog updated successfully.'
            ]);
        }
        return view("error");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (auth()->user()->id == $request->get('user_id')) {
            $blog = Blog::findOrFail($id);
            $blog->delete();

            return redirect('/blogs')->with(["deleteSuccess" => "blog deleted successfully."]);
        }
        return view('error');
    }
}
