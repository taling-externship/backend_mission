<?php

namespace App\Repositories;

use App\Models\Love;
use App\Models\Article;

class LoveRepository
{
    public function __construct(private Love $model)
    {
    }

    public function store(Article $article)
    {
        return $this->model->firstOrCreate([
            'article_id' => $article->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function destroy(Love $love)
    {
        return $love->delete();
    }
}
