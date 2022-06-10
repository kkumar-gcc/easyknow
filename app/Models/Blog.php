<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'blog_tag', 'blog_id', 'tag_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function pins()
    {
        return $this->hasMany(BlogPin::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function bloglikes()
    {
        return $this->hasMany(BlogLike::class);
    }
    public function blogviews()
    {
        return $this->hasMany(BlogView::class);
    }
    public function isBookmarked()
    {
        return $this->bookmarks()->where('user_id','=', auth()->user()->id)->exists();
    }

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        "status",
    ];
}
