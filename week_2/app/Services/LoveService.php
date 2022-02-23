<?php

namespace App\Services;

use App\Contracts\LoveInterface;
use App\Models\Love;
use App\Models\User;
use App\Models\Article;
use App\Repositories\LoveRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class LoveService implements LoveInterface
{
    public function __construct(private LoveRepository $repository)
    {
    }

    public function store(Article $article): RedirectResponse
    {
        if (Gate::denies('create', [Love::class])) {
            return redirect('/login');
        }

        $this->repository->store($article);

        return redirect($article->path);
    }

    public function destroy(Article $article, Love $love)
    {
        if (Gate::denies('delete', [$love, $article])) {
            return abort(405, 'You aren\'t authorized');
        }

        $this->repository->destroy($love);

        return redirect(route('article.index'));
    }
}
