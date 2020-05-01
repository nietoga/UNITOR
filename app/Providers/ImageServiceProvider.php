<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ImageStorage;
use App\Util\ImageS3Storage;
use App\Util\ImageLocalStorage;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageStorage::class, function () {
            return new ImageS3Storage();
            //return new ImageLocalStorage();
        });
    }
}
