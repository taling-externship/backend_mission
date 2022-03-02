<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Repositories\ArticleRepository;
use App\Contracts\AbstractArticleService;

class ArticleService extends AbstractArticleService
{
    public function __construct(private ArticleRepository $repository)
    {
    }

    public function getList(): View
    {
        $articles = $this->repository->getListWithPagination();
        return view('articles.list', compact('articles'));
    }

    public function createForm(): View | RedirectResponse
    {
        if (Gate::denies('create', Article::class)) {
            return redirect('/login');
        }
        return view('articles.form', [
            'method' => 'POST',
        ]);
    }

    public function store(array $params): RedirectResponse
    {
        if (Gate::denies('create', Article::class)) {
            return abort(401, 'You need to login');
        }

        $article = $this->repository->store($params);

        if (isset($params['tags'])) {
            $article = $this->repository->tagging($article, $params['tags']);
        }

        if (isset($params['attachment'])) {
            $article = $this->repository->attach($article);
        }

        return redirect()->route('article.show', $article)->with('success', 'Your Article is created well');
    }

    public function getOne($article): View
    {
        return view('articles.show', [
            'article' => $this->repository->getOneById($article->id)
        ]);
    }

    public function editForm($article): View
    {
        if (Gate::denies('update', $article)) {
            return abort(403, 'You are not permitted');
        }

        return view('articles.form', [
            'article' => $article,
            'method' => 'PATCH',
        ]);
    }

    public function update(array $params, Article $article): RedirectResponse
    {
        $article = $this->repository->updateOneByArticle($article, $params);

        if (isset($params['tags'])) {
            $article = $this->repository->tagging($article, $params['tags']);
        }

        if (isset($params['attachment'])) {
            $article = $this->repository->attach($article);
        }

        return redirect()->route('article.show', $article)->with('success', 'Your Article is updated well');
    }

    public function delete($article): RedirectResponse
    {
        if (Gate::denies('update', $article)) {
            return abort(403, 'You are not permitted');
        }

        $this->repository->destroyOneByArticle($article);

        return redirect(route('article.index'))->with('success', 'Your Article is deleted well');
    }
}
