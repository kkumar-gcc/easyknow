<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replylikes(){
        return $this->hasMany(ReplyLike::class);
    }

    public function isAuthUserLikedReply()
    {
        return $this->replylikes()->where(
            [['user_id',  auth()->user()->id], ['status', "=", 1]]
        )->exists();
    }
    public function isAuthUserDisLikedReply()
    {
        return $this->replylikes()->where(
            [['user_id',  auth()->user()->id], ['status', "=", 0]]
        )->exists();
    }
    protected $fillable=[
        'description',
        'comment_id',
    ];
}
