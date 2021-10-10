<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Storages\S3ImageDataStorage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(S3ImageDataStorage::class, function ($app) {
            return new S3ImageDataStorage('s3-image-bucket');
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
