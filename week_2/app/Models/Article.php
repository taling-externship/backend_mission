<?php

namespace App\Models;

use App\Models\User;
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

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['tags'] = $this->tags->toArray();
        return $array;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
