<?php

namespace App\Providers;

use App\Models\DataTransferObjectMapper;
use App\Models\IzitoastNotifyMessage;
use App\Models\JsonDataTransferObjectMapper;
use App\Models\NotifyMessage;
use App\Models\ProductNumberGenerator;
use App\Models\RandomProductNumberGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $this->app->bind(DataTransferObjectMapper::class, JsonDataTransferObjectMapper::class);
        $this->app->bind(ProductNumberGenerator::class, RandomProductNumberGenerator::class);
        $this->app->bind(NotifyMessage::class, IzitoastNotifyMessage::class);
    }
}
