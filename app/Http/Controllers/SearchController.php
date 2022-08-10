<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');
        $tab = "blogs";
        $blogs = Blog::query()->with(['user', 'tags'])->where([['title', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
            ->orWhere([['description', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
            ->paginate(10);
        $topUsers =  $topUsers = User::select(['id', 'username', 'profile_image'])->limit(5)->get();
        $topTags = Tag::withCount(['blogs' => function ($q) {
            $q->where('status', '=', "posted");
        }])->orderByDesc('blogs_count')->limit(10)->get();
        $topBlogs = Blog::select(['id', 'title', 'created_at'])->where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();

        return view('search.search')->with([
            "blogs" => $blogs,
            "query" => $query,
            "tab" => $tab,
            "topUsers" => $topUsers,
            "topTags" => $topTags,
            "topBlogs" => $topBlogs
        ]);
    }
    public function searchTag(Request $request)
    {
        $query = $request->get('query');
        $tags = Tag::query()->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->get();

        return response()->json([
            "searched" => true,
            "tags" => $tags,
        ]);
    }
    public function searchUser(Request $request)
    {
        $query = $request->get('query');
        $users = User::where('username', 'LIKE', "%{$query}%")
            ->get();
        return response()->json([
            "searched" => true,
            "users" => $users
        ]);
    }
    public function searchBlog(Request $request)
    {
        $query = $request->get('query');
        $blogs = Blog::query()->where([['title', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
            ->orWhere([['description', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
            ->withCount("comments")->get();
        return response()->json([
            "searched" => true,
            "blogs" => $blogs
        ]);
    }
    public function tag(Request $request)
    {
        $query = $request->get('query');
        $tab = 'tags';
        $tags = Tag::query()->with('blogs')->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(6);

        $topUsers =  $topUsers = User::select(['id', 'username', 'profile_image'])->limit(5)->get();
        $topTags = Tag::withCount(['blogs' => function ($q) {
            $q->where('status', '=', "posted");
        }])->orderByDesc('blogs_count')->limit(10)->get();
        $topBlogs = Blog::select(['id', 'title', 'created_at'])->where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();

        return view('search.search')->with([
            "tags" => $tags,
            "query" => $query,
            "tab" => $tab,
            "topUsers" => $topUsers,
            "topTags" => $topTags,
            "topBlogs" => $topBlogs
        ]);
    }
    public function user(Request $request)
    {
        $query = $request->get('query');
        $tab = "users";
        $users = User::select(['id','username','created_at','profile_image','short_bio'])->where('username', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->paginate(10);

        $topUsers =  $topUsers = User::select(['id', 'username', 'profile_image'])->limit(5)->get();
        $topTags = Tag::withCount(['blogs' => function ($q) {
            $q->where('status', '=', "posted");
        }])->orderByDesc('blogs_count')->limit(10)->get();
        $topBlogs = Blog::select(['id', 'title', 'created_at'])->where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();

        return view('search.search')->with([
            "users" => $users,
            "query" => $query,
            "tab" => $tab,
            "topUsers" => $topUsers,
            "topTags" => $topTags,
            "topBlogs" => $topBlogs
        ]);
    }
    public function blog(Request $request)
    {
        $query = $request->get('query');
        $tab = "blogs";
        $blogs = Blog::query()->with(['user', 'tags'])->where([['title', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
        ->orWhere([['description', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
        ->paginate(10);

        $topUsers =  $topUsers = User::select(['id', 'username', 'profile_image'])->limit(5)->get();
        $topTags = Tag::withCount(['blogs' => function ($q) {
            $q->where('status', '=', "posted");
        }])->orderByDesc('blogs_count')->limit(10)->get();
        $topBlogs = Blog::select(['id', 'title', 'created_at'])->where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();

        return view('search.search')->with([
            "blogs" => $blogs,
            "query" => $query,
            "tab" => $tab,
            "topUsers" => $topUsers,
            "topTags" => $topTags,
            "topBlogs" => $topBlogs
        ]);
    }

    public function topContent(Request $request)
    {
        $navType = $request->get('dataNavType');
        if ($navType == 'blog') {
            $topBlogs = Blog::where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();
            return response()->json(["type" => $navType, "topBlogs" => $topBlogs]);
        } else if ($navType == 'tag') {
            $topTags = Tag::withCount(['blogs' => function ($q) {
                $q->where('status', '=', "posted");
            }])->orderByDesc('blogs_count')->limit(10)->get();
            return response()->json(["type" => $navType, "topTags" => $topTags]);
        }
    }
}
