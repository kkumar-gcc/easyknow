<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentlikes()
    {
        return $this->hasMany(CommentLike::class);
    }
    public function isAuthUserLikedComment()
    {
        return $this->commentlikes()->where(
            [['user_id',"=",auth()->user()->id], ['status', "=", 1]]
        )->exists();
    }
    public function isAuthUserDisLikedComment()
    {
        return $this->commentlikes()->where(
            [['user_id','=',auth()->user()->id], ['status', "=", 0]]
        )->exists();
    }
    protected $fillable = [
        'description',
        'blog_id',
    ];
}
