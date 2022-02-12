<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany('App\\Models\\Tag', 'articles_tags',);
    }
}
