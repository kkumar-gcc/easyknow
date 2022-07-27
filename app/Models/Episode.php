<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
    protected $fillable = [
        'podcast_id',
        'link',
        'title',
        'description',
        'serial_number' 
    ];
}
