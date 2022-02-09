<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Article;

class ArticleService implements ArticleInterface
{
    public function __construct(private Article $model)
    {
    }

    public function store()
    {
        $params = request()->validate([
            'title' => 'required|max:255',
            'body'  => 'max:3000',
            'tags'  => 'array|max:50',
        ]);

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

        return redirect('/article')->with('success', 'Your Article is created well');
    }
}
