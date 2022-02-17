<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\View\View;

class ArticleService implements ArticleInterface
{
    public function __construct(private Article $model)
    {
    }

    public function getList(): View
    {
        return view('articles.list', [
            'articles' => $this->model->latest()->with('tags')->paginate(15),
        ]);
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

        $article = $this->model->create([
            'title' => $params['title'],
            'body' => $params['body'],
            'user_id' => Auth::id(),
        ]);

        if (isset($params['tags'])) {
            $tags = [];

            foreach ($params['tags'] as $tag) {
                if (!$tag) continue;
                $createdTag = Tag::firstOrCreate([
                    'name' => $tag,
                ]);
                array_push($tags, $createdTag->id);
            }

            $article->tags()->syncWithoutDetaching($tags);
        }

        return redirect()->route('article.show', $article)->with('success', 'Your Article is created well');
    }

    public function getOne($article): View
    {
        return view('articles.show', compact('article'));
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
        $article->update([
            'title' => $params['title'],
            'body' => $params['body'],
        ]);

        if (isset($params['tags'])) {
            $tags = [];

            foreach ($params['tags'] as $tag) {
                if (!$tag) continue;
                $createdTag = Tag::firstOrCreate([
                    'name' => $tag,
                ]);
                array_push($tags, $createdTag->id);
            }

            $article->tags()->sync($tags);
        }

        return redirect()->route('article.show', $article)->with('success', 'Your Article is updated well');
    }

    public function delete($article): RedirectResponse
    {
        if (Gate::denies('update', $article)) {
            return abort(403, 'You are not permitted');
        }
        $article->delete();
        return redirect(route('article.index'))->with('success', 'Your Article is deleted well');
    }
}
