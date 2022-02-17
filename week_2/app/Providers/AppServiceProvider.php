<?php

namespace App\Providers;

use App\Models\Board;
use App\Services\Board\BoardInterface;
use App\Services\Board\BoardService;
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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        app()->bind(BoardInterface::class, function () {
            return new BoardService(new Board());
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
