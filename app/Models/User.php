<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public function blogs(){
        return $this->hasMany(Blog::class);
    }
    public function friendships(){
        return $this->hasMany(Friendship::class);
    }
    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }
   
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function commentlikes(){
        return $this->hasMany(BlogLike::class);
    }
    public function replylikes(){
        return $this->hasMany(ReplyLike::class);
    }
    public function bloglikes(){
        return $this->hasMany(BlogLike::class);
    }
    public function isFollower()
    {
        return $this->friendships()->where('follower_id','=', auth()->user()->id)->exists();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'description',
        'image',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
