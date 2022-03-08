<?php

namespace App\Contracts;

use App\Models\Love;
use App\Models\Article;

interface LoveInterface
{
    public function store(Article $article);
    public function destroy(Article $article, Love $love);
}
