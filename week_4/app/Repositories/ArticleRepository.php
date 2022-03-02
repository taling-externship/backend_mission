<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

class ArticleRepository
{
    public function __construct(private Article $model)
    {
    }

    public function getListWithPagination(): LengthAwarePaginator
    {
        return $this->model->latest()->with('tags:id,name')->with('love:id,article_id,user_id')->paginate(15);
    }

    public function getOneById(int $id): Article
    {
        return $this->model->with('tags')->where('id', $id)->first();
    }

    public function store(array $params): Article
    {
        $article = $this->model->create([
            'title' => $params['title'],
            'body' => $params['body'],
            'user_id' => Auth::id(),
        ]);

        if (isset($params['tags'])) {
            foreach ($params['tags'] as $tag) {
                if (!$tag) continue;
                $createdTag = Tag::firstOrCreate([
                    'name' => $tag,
                ]);
                $tags[] = $createdTag->id;
            }

            $article->tags()->syncWithoutDetaching($tags);
        }

        return $this->model->with('tags')->where('id', $article->id)->first();
    }

    public function updateOneByArticle(Article $article, array $params): Article
    {
        $article->update([
            'title' => $params['title'],
            'body' => $params['body'],
        ]);

        if (isset($params['tags'])) {
            foreach ($params['tags'] as $tag) {
                if (!$tag) continue;
                $createdTag = Tag::firstOrCreate([
                    'name' => $tag,
                ]);
                $tags[] = $createdTag->id;
            }

            $article->tags()->sync($tags);
        }

        return $this->model->with('tags:id,name')->where('id', $article->id)->first();
    }

    public function destroyOneByArticle(Article $article): bool
    {
        return $article->delete();
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file 첨부파일
     * @return \App\Models\Article Article에 with attachment 추가
     */
    public function attach(Article $article, UploadedFile $file, string $store_name): Article
    {
        $attachment = Attachment::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $store_name,
            'article_id' => $article->id,
        ]);

        $attachment->makeHidden(['created_at', 'updated_at', 'stored_name', 'article_id']);
        $article->attachment = $attachment;

        return $article;
    }
}
