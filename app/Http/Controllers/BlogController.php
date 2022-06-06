<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\BlogView;
use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Tag;
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
    public function index(Request $request)
    {
        $blogCount = Blog::where("status", "=", "posted")->count();
        $tab = 'newest';

        if ($request->tab == 'likes') {
            $blogs = Blog::where("status", "=", "posted")->withCount(['bloglikes' => function ($q) {
                $q->where('status', '=', 1);
            }])->orderByDesc('bloglikes_count')->paginate(10);
        } else if ($request->tab == 'newest') {
            $blogs = Blog::where("status", "=", "posted")->orderByDesc('created_at')->paginate(10);
        } else if ($request->tab == 'views') {
            $blogs = Blog::where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->paginate(10);
        } else {
            $blogs = Blog::where("status", "=", "posted")->orderByDesc('created_at')->paginate(10);
        }
        if ($request->tab) {
            $tab = $request->tab;
        }
        $tags = Tag::all();
        return view("blogs.index")->with([
            "blogs" => $blogs,
            "blogCount" => $blogCount,
            "tab" => $tab,
            "tags" => $tags
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
            $last_draft = Blog::where([['user_id', auth()->user()->id], ['status', "drafted"]])->OrderBy('updated_at', 'desc')->first();
            $tagTitles = [];
            if ($last_draft) {
                foreach ($last_draft->tags as $tag) {
                    $tagTitles[] = $tag->title;
                }
            }
            $isDraftNull = 0;
            if ($last_draft) {
                $isDraftNull = 1;
            }
            return view("blogs.create")
                ->with(["draft" => $last_draft, "tagTitles" => json_encode($tagTitles), "isDraftNull" => $isDraftNull]);
        } else {
            return view("auth.login")->with(["warning" => "You must be logged in to create Blog."]);
        }
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
        $tagNames = json_decode($request->get('tags'));

        if ($blogId != '') {

            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $tagIds = [];
            $tagTitles = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                    $tagTitles[] = $tag->title;
                }
            };
            $blog->save();
            $blog->tags()->sync($tagIds);
        } else {
            $blog = new Blog();
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->status = "drafted";
            $blog->user_id = auth()->user()->id;
            $tagIds = [];
            $tagTitles = [];
            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                    $tagTitles[] = $tag->title;
                }
            };
            $blog->save();
            $blog->tags()->sync($tagIds);

            $blogId = $blog->id;
        }

        return response()->json([
            "success" => 'post created successfully',
            "blogId" => $blogId,
            "tagTitles" => $request->get('tags')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
// dd(request()->userAgent());
        $blog = Blog::find($id);
        $like = NULL;
        if ($blog) {
            if ($blog->status == "posted") {

                $existView = BlogView::where([['ip_address', "=", $request->ip()], ["blog_id", "=", $id]])->count();
                if ($existView < 1) {
                    $newView = new BlogView();
                    $newView->ip_address = $request->ip();
                    $newView->blog_id = $id;
                    $newView->save();
                }
                $tagTitles = [];
                foreach ($blog->tags as $tag) {
                    $tagTitles[] = $tag->title;
                }
                if (Auth::check()) {
                    $like = BlogLike::where([
                        ["blog_id", "=", $id],
                        ["user_id", "=", auth()->user()->id]
                    ])->first();
                }
                $related = Blog::with('tags')->whereHas('tags', function ($query) use ($blog) {
                    $query->whereIn('title', $blog->tags->pluck('title'));
                }, '>=', count($blog->tags->pluck('title')))->where("id", "!=", $blog->id)->limit(5)->withCount('tags')
                    ->get();
                // dd($related);
                if ($request->tab == 'likes') {
                    $comments = Comment::where("blog_id", "=", $id)->withCount(['commentlikes' => function ($q) {
                        $q->where('status', '=', 1);
                    }])->orderByDesc('commentlikes_count')->paginate(5)->fragment('comments');
                } else if ($request->tab == 'newest') {
                    $comments = Comment::where("blog_id", "=", $id)->orderByDesc("updated_at")->paginate(5)->fragment('comments');
                } else if ($request->tab == 'dislikes') {
                    $comments = Comment::where("blog_id", "=", $id)->withCount(['commentlikes' => function ($q) {
                        $q->where('status', '=', 0);
                    }])->orderByDesc('commentlikes_count')->paginate(5)->fragment('comments');
                } else {
                    $comments = Comment::where("blog_id", "=", $id)->orderByDesc("created_at")->paginate(5)->fragment('comments');
                }

                return view("blogs.show")->with([
                    "blog" => $blog,
                    "comments" => $comments,
                    "like" => $like,
                    "tagTitles" => json_encode($tagTitles),
                    "related" => $related
                ]);
            }
        }
        return view("error");
    }
    public function ndshow($id)
    {

        $blog = Blog::find($id);
        $friendship = NULL;
        $like = NULL;
        if ($blog) {
            if ($blog->status == "posted") {
                if (Auth::check()) {
                    $friendship = Friendship::where([
                        ["user_id", "=", $blog->user_id],
                        ["follower_id", "=", auth()->user()->id]
                    ])->count();
                    $like = BlogLike::where([
                        ["blog_id", "=", $id],
                        ["user_id", "=", auth()->user()->id]
                    ])->first();
                }

                $comments = Comment::where("blog_id", "=", $id)->paginate(5)->fragment('comments');
                return view("blogs.ndshow")->with([
                    "blog" => $blog,
                    "comments" => $comments,
                    "friendship" => $friendship,
                    "like" => $like
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
        $tagNames = json_decode($request->get('tags'));
        if ($blogId != NULL) {
            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->status = "posted";
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            };
            $blog->save();
            $blog->tags()->sync($tagIds);
        } else {
            $blog = new Blog();
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            $blog->status = "posted";
            $blog->user_id = auth()->user()->id;
            $tagIds = [];
            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            };
            $blog->save();
            $blog->tags()->sync($tagIds);

            $blogId = $blog->id;
        }


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
            $tagNames = json_decode($request->get('tags'));

            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDescription;
            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate(['title' => $tagName]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                    $tagTitles[] = $tag->title;
                }
            };
            $blog->tags()->sync($tagIds);
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
    public function tagSearch(Request $request, $title)
    {
        $searchTag = Tag::where("title", "=", $title)->first();

        $blogCount = Blog::where("status", "=", "posted")->whereHas('tags', function ($q) use ($title) {
            $q->where('title', $title);
        })->count();
        $tab = 'newest';
        if ($request->tab == 'likes') {
            $blogs = Blog::where("status", "=", "posted")->whereHas('tags', function ($q) use ($title) {
                $q->where('title', $title);
            })->withCount(['bloglikes' => function ($q) {
                $q->where('status', '=', 1);
            }])->orderByDesc('bloglikes_count')->paginate(10);
        } else if ($request->tab == 'newest') {
            $blogs = Blog::where("status", "=", "posted")->whereHas('tags', function ($q) use ($title) {
                $q->where('title', $title);
            })->orderByDesc('created_at')->paginate(10);
        } else if ($request->tab == 'views') {
            $blogs = Blog::where("status", "=", "posted")->whereHas('tags', function ($q) use ($title) {
                $q->where('title', $title);
            })->withCount('blogviews')->orderByDesc('blogviews_count')->paginate(10);
        } else {
            $blogs = Blog::where("status", "=", "posted")->whereHas('tags', function ($q) use ($title) {
                $q->where('title', $title);
            })->orderByDesc('created_at')->paginate(10);
        }

        if ($request->tab) {
            $tab = $request->tab;
        }
        return view("blogs.tagged")->with([
            "blogs" => $blogs,
            "blogCount" => $blogCount,
            "searchTag" => $searchTag,
            "tab" => $tab
        ]);
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
