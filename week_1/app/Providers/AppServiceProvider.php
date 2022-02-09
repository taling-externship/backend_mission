<?php

namespace App\Providers;

use App\Models\Article;
use App\Services\ArticleInterface;
use App\Services\ArticleService;
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
        app()->bind(ArticleInterface::class, function () {
            return new ArticleService(new Article());
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
