<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Models\Article;
use App\Contracts\AbstractArticleService;
use App\Contracts\LoveInterface;
use App\Models\Love;
use App\Repositories\LoveRepository;
use App\Services\ArticleService;
use App\Services\ApiArticleService;
use App\Services\ApiLoveService;
use App\Services\LoveService;
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

        app()->bind(LoveInterface::class, function () {
            if (request()->expectsJson()) {
                return new ApiLoveService(new LoveRepository(new Love()));
            }
            return new LoveService(new LoveRepository(new Love()));
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
