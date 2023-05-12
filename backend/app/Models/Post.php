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
}
