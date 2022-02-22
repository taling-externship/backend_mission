<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

interface ArticleInterface
{
    public function getList(): View | JsonResponse;
    public function store(array $params): RedirectResponse | JsonResponse;
    public function getOne($article): View | JsonResponse;
    public function update(array $params, Article $article): RedirectResponse | JsonResponse;
    public function delete($article): RedirectResponse | JsonResponse;
}
