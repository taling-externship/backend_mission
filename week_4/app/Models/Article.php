<?php

namespace App\Models;

use App\Models\User;
use App\Models\Attachment;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPathAttribute()
    {
        return route('article.show', $this);
    }

    public function love()
    {
        return $this->hasMany(Love::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }

    public function getMyLovedAttribute()
    {
        return auth()->check() ? $this->love()->where([
            'user_id' => auth()->user()->id,
            'article_id' => $this->id,
        ])->first() : false;
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['tags'] = $this->tags->toArray();
        return $array;
    }
}
