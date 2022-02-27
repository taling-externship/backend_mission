<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Models\Article;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /** is_show 가 true 인 데이터 목록을 출력하여 리턴한다. */
    public function getArticles(): Response
    {
        $rows = Article::where('is_show', true)->get();

        return response()->json(['data' => $rows, 'message' => '공개중인 모든 데이터를 전달함'], 200);
    }

    /** Article 추가 */
    public function addArticle(CreateRequest $request): Response
    {
        $fields = $request->validated();
        $article = Article::create([
            'slug_id' => Str::uuid(),
            'slug' => strtolower(preg_replace('/[^a-zA-Z가-힣0-9]+/', '-', trim($fields['slug']))),
            'url' => $fields['url'],
            'title' => $fields['title'],
            'content' => $fields['content'],
            'is_show' => true,
        ]);

        return response()->json(['data' => $article, 'message' => '추가한 테이터를 전달함'], 200);
    }

    /** 1개의 아티클 보여줌. */
    public function getArticle(string $slug_id, string $slug): Response
    {
        $articles = Article::where('slug_id', $slug_id)->where('is_show', true)->orderBy('id', 'asc')->firstOrFail();

        if ($articles->slug !== $slug) {
            return redirect("/articles/$slug_id/$articles->slug");
        }
        return response()->json(['data' => $articles, 'message' => 'show 데이터를 하나 전달함'], 200);
    }

    /** 아티클 업데이트. */
    public function update(Article $article): JsonResponse
    {
        $fields = Article::where('id', $article->id)->update([
            'title' => $article->title,
            'content' => $article->content,
            'is_show' => $article->is_show,
        ]);

        if ($fields) {
            return response()->json(['data' => $fields, 'message' => '데이터를 업데이트 함'], 200);
        }

        return response()->json(['message' => '데이터 업데이트에 실패함'], 500);
    }

    /** 아티클 삭제. */
    public function delete(int $id): Response
    {
        $result = Article::where('id', $id)->delete();

        if ($result) {
            return response()->json(['data' => $result, 'message' => '데이터 삭제에 성공함'], 200);
        }

        return response()->json(['message' => 'a 데이터 삭제에 실패함'], 500);
    }
}
