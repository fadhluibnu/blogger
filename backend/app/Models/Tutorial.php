<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'slug',
        'roadmap_id',
        'description'
    ];

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class, 'roadmap_id');
    }
    public function dataTutorial()
    {
        return $this->hasMany(DataTutorial::class, 'id_playlist');
    }
}
