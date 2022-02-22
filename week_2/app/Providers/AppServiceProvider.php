<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Models\Article;
use App\Services\AbstractArticleService;
use App\Services\ArticleService;
use App\Services\ApiArticleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(AbstractArticleService::class, function () {
            if (request()->expectsJson()) {
                return new ApiArticleService(new ArticleRepository(new Article()));
            }
            return new ArticleService(new ArticleRepository(new Article()));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
