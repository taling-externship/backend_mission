<?php

namespace App\Services;

use App\Models\Love;
use App\Models\Article;
use App\Contracts\LoveInterface;
use App\Repositories\LoveRepository;
use Illuminate\Support\Facades\Gate;

class ApiLoveService implements LoveInterface
{
    public function __construct(private LoveRepository $repository)
    {
    }

    public function store(Article $article)
    {
        if (Gate::denies('create', [Love::class])) {
            return response()->json([
                'result' => 'fail',
                'message' => "You don't have a permission",
            ]);
        }

        $result = $this->repository->store($article);

        return response()->json([
            'result' => 'success',
            'data' => $result,
        ]);
    }

    public function destroy(Article $article, Love $love)
    {
        if (Gate::denies('delete', [$love, $article])) {
            return response()->json([
                'result' => 'fail',
                'message' => 'You aren\'t authorized',
            ], 405);
        }

        $this->repository->destroy($love);

        return response()->json([
            'result' => 'success',
        ]);
    }
}
