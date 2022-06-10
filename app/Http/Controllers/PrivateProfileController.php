<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Bookmark;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ImageTrait;

class PrivateProfileController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id, $username)
    {
        if ($id == auth()->user()->id) {
            $tab = "profile";
            if ($request->tab == 'profile') {
                $tab = 'profile';
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            } else if ($request->tab == "password") {
                $tab = 'password';
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            } else if ($request->tab == "blogs") {
                $tab = 'blogs';
                $blogs = Blog::where("user_id", "=", $id)->where('status', '=', 'posted')->paginate(5);
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "blogs" => $blogs,
                    "tab" => $tab
                ]);
            } else if ($request->tab == "drafts") {
                $tab = 'drafts';
                $drafts = Blog::where("user_id", "=", $id)->where('status', '=', 'drafted')->paginate(5);
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "drafts" => $drafts,
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'bookmarks') {
                $tab = 'bookmarks';
                $bookmarks = Bookmark::where("user_id", "=", $id)->paginate(5);
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "bookmarks" => $bookmarks,
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'follower') {
                $tab = 'follower';
                $followers = Friendship::where("user_id", "=", $id)->paginate(5);
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "followers" => $followers,
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'following') {
                $tab = 'following';
                $followings = Friendship::where("follower_id", "=", $id)->paginate(5);
                // dd($followings);
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "followings" => $followings,
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'pins') {
                $tab = 'pins';
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            } else  if ($request->tab == 'tags') {
                $tab = 'tags';
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            } else if ($request->tab == 'comments') {
                $tab = 'comments';
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            } else if ($request->tab == "about") {
                $tab = "about";
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            } else {
                return view("profile.private.index")->with([
                    "user" => auth()->user(),
                    "tab" => $tab
                ]);
            }
        }

        return redirect()->back();
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
     * @param  \App\Http\Requests\StoreReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "profile_image" => 'sometimes|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "background_image" => 'sometimes|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "username"=>'required'
        ]);
        if (auth()->user()->id == $request->get('user_id')) { 
            $user = User::find(auth()->user()->id);
            if($request->hasFile('profile_image')){
                $profileImage = $this->uploads($request->file('profile_image'));
                $user->profile_image = $profileImage['filePath'];
            }
            if($request->hasFile('background_image')){
                $backgroundImage = $this->uploads($request->file('background_image'));
                $user->background_image = $backgroundImage['filePath'];
            }
            $user->name = $request->get('name');
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->about_me = $request->get('about_me');
            $user->short_bio = $request->get('short_bio');
            $user->website_url = $request->get('website_url');
            $user->twitter_url = $request->get('twitter_url');
            $user->github_url = $request->get('github_url');
            $user->facebook_url = $request->get('facebook_url');
            $saved = $user->save();
            if ($saved) {
                return response()->json(["success"=>"profile updated successfully"]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReplyRequest  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
