<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\BookAdvisor;
use App\Util\GoogleBookAdvisor;

class BookAdvisorServiceProvider extends ServiceProvider
{
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(BookAdvisor::class, function (){
            return new GoogleBookAdvisor();
        });
    }
}