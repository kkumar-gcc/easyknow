<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function blog(){
        return $this->belongsTo(Blog::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'description',
        'blog_id',
        'likes',
        'dislikes'
    ];
}
