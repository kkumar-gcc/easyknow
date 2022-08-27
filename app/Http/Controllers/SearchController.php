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
        
        $blogs = Blog::where("status","=","posted")->where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->orderByDesc('updated_at')
        ->paginate(10);
        return view('search.search')->with([
            "blogs" => $blogs,
            "query" => $query,
            "tab" => $tab
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
        return view('search.search')->with([
            "tags" => $tags,
            "query" => $query,
            "tab" => $tab
        ]);
    }
    public function user(Request $request)
    {
        $query = $request->get('query');
        $tab = "users";
        $users = User::select(['id','username','created_at','profile_image','short_bio'])->where('username', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->paginate(10);

        return view('search.search')->with([
            "users" => $users,
            "query" => $query,
            "tab" => $tab
        ]);
    }
    public function blog(Request $request)
    {
        $query = $request->get('query');
        $tab = "blogs";
        $blogs = Blog::query()->with(['user', 'tags'])->where([['title', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
        ->orWhere([['description', 'LIKE', "%{$query}%"], ["status", "=", "posted"]])
        ->paginate(10);
        return view('search.search')->with([
            "blogs" => $blogs,
            "query" => $query,
            "tab" => $tab
        ]);
    }
}
