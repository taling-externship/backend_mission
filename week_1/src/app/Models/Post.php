<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeListSearch($query, $searchWord)
    {
        if (empty($searchWord)) {
            return $query;
        }
        return $query->where('title', 'LIKE', "%{$searchWord}%")->orWhere('notes', 'LIKE', "%{$searchWord}%");
    }
}
