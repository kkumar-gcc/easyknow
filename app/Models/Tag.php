<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;
    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }
    public function description(): ?string
    {
        return $this->description;
    }
    public function styleColor() : string 
    {
        return $this->color;
    }
    public function slug(): string
    {
        return $this->slug;
    }
    public function creator(): int
    {
        return $this->user;
    }
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
    public function funs()
    {
        return $this->belongsToMany(Fun::class);
    }
    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
    protected $fillable = [
        'title',
        'description',
        'color',
        'user_id',
        'slug'
    ];
}
