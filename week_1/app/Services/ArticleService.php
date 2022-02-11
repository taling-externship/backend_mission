<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Article;

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

    public function store()
    {
        $params = $this->validate(request());

        $article = $this->model->create([
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

    private function validate($request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'body'  => 'max:3000',
            'tags'  => 'array|max:50',
        ]);
    }
}
