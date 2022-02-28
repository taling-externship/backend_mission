<?php

namespace App\Interfaces;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;

interface ArticleInterface
{
    public function getArticles();

    public function getArticle(string $slug_id, string $slug);

    public function addArticle(CreateRequest $request);

    public function updateArticle(UpdateRequest $request);

    public function deleteArticle(int $id);
}
