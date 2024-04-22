<?php

namespace App\Providers;

// this is upgrade of laravel 7 to laravel 8 link() error on pagination
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();
// --
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
        //
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
