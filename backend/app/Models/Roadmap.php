<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'slug'
    ];
    public function tutorials()
    {
        $this->hasMany(Tutorial::class, 'roadmap_id');
    }
}
