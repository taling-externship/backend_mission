<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Repositories\Article\ArticleInterface;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    protected ArticleInterface $articleInterface;

    public function __construct(ArticleInterface $articleInterface)
    {
        $this->articleInterface = $articleInterface;
    }

    /** is_show 가 true 인 데이터 목록을 출력하여 리턴한다. */
    public function getArticles(): JsonResponse
    {
        return $this->articleInterface->getArticles();
    }

    /** Article 추가 */
    public function addArticle(CreateRequest $request)
    {
        return $this->articleInterface->addArticle($request);
    }

    /** 1개의 아티클 보여줌. */
    public function getArticle(string $slug_id, string $slug)
    {
        return $this->articleInterface->getArticle($slug_id, $slug);
    }

    /** 아티클 업데이트. */
    public function update(UpdateRequest $article): JsonResponse
    {
        return $this->articleInterface->updateArticle($article);
    }

    /** 아티클 삭제. */
    public function delete(int $id): JsonResponse
    {
        return $this->articleInterface->deleteArticle($id);
    }
}
