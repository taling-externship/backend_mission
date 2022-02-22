<?php

namespace App\Services;

use App\Models\Love;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class LoveService
{
    public function __construct(private Love $model)
    {
    }

    public function store(Article $article): RedirectResponse
    {
        if (Gate::denies('create', $this->model)) {
            return redirect('/login');
        }
        $this->model->create([
            'article_id' => $article->id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect($article->path);
    }

    public function destroy(Article $article, Love $love)
    {
        if (Gate::denies('delete', [$love, $article])) {
            return abort(405, 'You aren\'t authorized');
        }

        $love->delete();

        return redirect(route('article.index'));
    }
}
