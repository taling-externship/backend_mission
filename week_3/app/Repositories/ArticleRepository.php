<?php

namespace App\Repositories;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Traits\ApiResponseTrait as Response;
use App\Interfaces\ArticleInterface;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

class ArticleRepository implements ArticleInterface
{
    use Response;

    /** is_show 가 true 인 데이터 목록을 출력하여 리턴한다. */
    public function getArticles(): JsonResponse
    {
        try {
            $articles = Article::where('is_show', true)->get();
            return $this->success('모든 게시글', $articles);
        } catch (\Exception $err) {
            return $this->error($err->getMessage(), $err->getCode());
        }
    }

    /** Article 추가 */
    public function addArticle(CreateRequest $request): JsonResponse
    {
        try {
            $newArticle = $request->validated();
            $newArticle = Article::create([
                'slug_id' => Str::uuid(),
                'slug' => strtolower(preg_replace('/[^a-zA-Z가-힣0-9]+/', '-', trim($newArticle['title']))),
                'title' => $newArticle['title'],
                'content' => $newArticle['content'],
                'is_show' => true,
            ]);
            return $this->success("아티클을 추가했다.", $newArticle, 200);
        } catch (\Exception $err) {
            return $this->error($err->getMessage(), $err->getCode());
        }
    }

    /** 1개의 아티클 보여줌. */
    public function getArticle(string $slug_id, string $slug): JsonResponse|Redirector|RedirectResponse|Application
    {
        try {
            $articles = Article::where('slug_id', $slug_id)->where('is_show', true)->orderBy('id', 'asc')->first();

            if ($articles->slug !== $slug) {
                return redirect("/api/articles/$slug_id/$articles->slug");
            }

            if (!$articles) {
                return $this->error("선택한 아티클이 존재하지 않습니다.", 404);
            }
            return $this->success("선택한 아티클이 존재합니다.", $articles);
        } catch (\Exception $err) {
            return $this->error($err->getMessage(), $err->getCode());
        }
    }

    /** 아티클 업데이트. */
    public function updateArticle(UpdateRequest $request): JsonResponse
    {
        try {
            $article = $request->validated();
            Article::where('id', $article['id'])->update([
                'title' => $article['title'],
                'slug' => strtolower(preg_replace('/[^a-zA-Z가-힣0-9]+/', '-', trim($article['title']))),
                'content' => $article['content'],
                'is_show' => $article['is_show'],
            ]);
            $article = Article::find($article['id']);

            if (!$article) {
                return $this->error("선택한 아티클이 존재하지 않습니다.", 404);
            }
            return $this->success("선택한 아티클이 존재합니다.", $article);
        } catch (\Exception $err) {
            return $this->error($err->getMessage(), $err->getCode());
        }

        return response()->json(['data' => $article, 'message' => '데이터를 업데이트 함'], 200);
    }

    /** 아티클 삭제. */
    public function deleteArticle(int $id): JsonResponse
    {
        try {
            $article = Article::find($id);
            if (!$article) {
                return $this->error("아티클을 삭제함", 404);
            }
            $article->delete();
            return $this->success('사용자 정보 삭제했음. ');
        } catch (\Exception $err) {
            return $this->error($err->getMessage(), $err->getCode());
        }
    }
}
