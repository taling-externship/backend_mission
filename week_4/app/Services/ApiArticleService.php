<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Storage;
use App\Contracts\AbstractArticleService;

class ApiArticleService extends AbstractArticleService
{
    public function __construct(private ArticleRepository $repository)
    {
    }

    public function getList(): JsonResponse
    {
        return response()->json($this->repository->getListWithPagination());
    }

    public function store(array $params): JsonResponse
    {
        if (Gate::denies('create', Article::class)) {
            return response()->json([
                'result' => 'fail',
                'message' => 'You should login first',
            ]);
        }

        $article = $this->repository->store($params);

        if (isset($params['tags'])) {
            $article = $this->repository->tagging($article, $params['tags']);
        }

        if (isset($params['attachment'])) {
            $article = $this->repository->attach($article);
        }

        return response()->json($article->toArray());
    }

    public function getOne($article): JsonResponse
    {
        return response()->json($this->repository->getOneById($article->id)->toArray());
    }

    public function update(array $params, Article $article): JsonResponse
    {
        if (Gate::denies('update', $article)) {
            return response()->json([
                'result' => 'fail',
                'message' => "You don't have a permission",
            ]);
        }

        $article = $this->repository->updateOneByArticle($article, $params);

        if (isset($params['tags'])) {
            $article = $this->repository->tagging($article, $params['tags']);
        }

        if (isset($params['attachment'])) {
            $article = $this->repository->attach($article);
        }

        return response()->json([
            'result' => 'success',
        ]);
    }

    public function delete($article): JsonResponse
    {
        if (Gate::denies('update', $article)) {
            return response()->json([
                'result' => 'fail',
                'message' => "You don't have a permission",
            ]);
        }

        $this->repository->destroyOneByArticle($article);

        return response()->json([
            'result' => 'success',
        ]);
    }
}
