<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\File;
use App\Models\Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

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
        return $this->model->with(['tags', 'attachment'])->where('id', $id)->first();
    }

    public function store(array $params): Article | Throwable
    {
        try {
            DB::beginTransaction();

            $article =  $this->model->create([
                'title' => $params['title'],
                'body' => $params['body'],
                'user_id' => Auth::id(),
            ]);

            if (isset($params['tags'])) {
                $article = $this->tagging($article, $params['tags']);
            }

            if (isset($params['attachment'])) {
                $article = $this->attach($article);
            }

            DB::commit();

            return $article;
        } catch (Throwable $e) {
            DB::rollback();

            return $e;
        }
    }

    public function updateOneByArticle(Article $article, array $params): Article | Throwable
    {
        try {
            DB::beginTransaction();

            $article->update([
                'title' => $params['title'],
                'body' => $params['body'],
            ]);

            if (isset($params['tags'])) {
                $article = $this->tagging($article, $params['tags']);
            }

            if (isset($params['attachment'])) {
                $article = $this->attach($article);
            }

            DB::commit();

            return $article;
        } catch (Throwable $e) {
            DB::rollback();

            return $e;
        }
    }

    public function destroyOneByArticle(Article $article): bool
    {
        return $article->delete();
    }


    public function tagging(Article $article, array $tags): Article
    {
        foreach ($tags as $tag) {
            if (!$tag) continue;
            $createdTag = Tag::firstOrCreate([
                'name' => $tag,
            ]);

            $article->tags[] = $createdTag->makeHidden(['created_at', 'updated_at']);
            $tag_ids[] = $createdTag->id;
        }

        $article->tags()->sync($tag_ids);

        return $article;
    }

    /**
     * @param \App\Models\Article $article 원글
     * @param \Illuminate\Http\UploadedFile $file 첨부파일
     * @param string $store_name 저장path + name
     * @return \App\Models\Article Article에 with attachment 추가
     */
    public function attach(Article $article): Article
    {
        $file = request()->file('attachment');

        $file_path = '/' . date('Ym') . '/' . $article->id;
        $file_name = Auth::id() . date('dHis') . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('attachment' . $file_path, new File($file->getPathname()), $file_name);

        $attachment = Attachment::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => "{$file_path}/{$file_name}",
            'article_id' => $article->id,
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
        ]);

        $attachment->makeHidden(['created_at', 'updated_at', 'stored_name', 'article_id']);
        $article->attachment = $attachment;

        return $article;
    }
}
