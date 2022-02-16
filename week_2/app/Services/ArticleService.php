<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleService implements ArticleInterface
{
    public function __construct(private Article $model)
    {
    }

    public function getList()
    {
        return view('articles.list', [
            'articles' => $this->model->latest()->with('tags')->paginate(15),
        ]);
    }

    public function createForm()
    {
        if (Gate::denies('create', Article::class)) {
            return redirect('/login');
        }
        return view('articles.form', [
            'method' => 'POST',
        ]);
    }

    public function store()
    {
        if (Gate::denies('create', Article::class)) {
            return abort(401, 'You need to login');
        }

        $params = $this->validate(request());

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

    public function getOne($article)
    {
        return view('articles.show', compact('article'));
    }

    public function editForm($article)
    {
        return view('articles.form', [
            'article' => $article,
            'method' => 'PATCH',
        ]);
    }

    public function update($article)
    {
        $params = $this->validate(request());

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

    public function delete($article)
    {
        $article->delete();
        return redirect(route('article.index'))->with('success', 'Your Article is deleted well');
    }

    private function validate($request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'body'  => 'max:3000',
            'tags.*'  => 'max:50',
        ]);
    }
}
