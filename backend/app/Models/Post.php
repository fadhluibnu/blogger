<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'title',
        'meta_desc',
        'slug',
        'tag',
        'id_tutorial',
        'id_category',
        'image_cover',
        'body',
        'views'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
    public function dataTutorial()
    {
        return $this->hasOne(DataTutorial::class, 'id_post');
    }
    // public function datatutorials()
    // {
    //     return $this->belongsToMany(DataTutorial::class, 'data_tutorials', 'id_post');
    // }
}
