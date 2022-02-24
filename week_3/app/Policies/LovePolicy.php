<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Article;
use App\Models\Love;

class LovePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Love $love, Article $article)
    {
        return $love->article->id === $article->id && $love->user->id === $user->id;
    }
}
