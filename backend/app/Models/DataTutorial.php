<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTutorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_playlist',
        'id_post',
        'playlist_order'
    ];
    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
    public function tutorials()
    {
        return $this->belongsTo(Tutorial::class, 'id_playlist');
    }
}
