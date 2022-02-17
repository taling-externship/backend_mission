<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

interface ArticleInterface
{
    public function createForm(): View;
    public function store(array $params): RedirectResponse;
    public function getList(): View;
    public function getOne($article): View;
    public function editForm($article): View;
    public function update(array $params, Article $article): RedirectResponse;
    public function delete($article): RedirectResponse;
}
