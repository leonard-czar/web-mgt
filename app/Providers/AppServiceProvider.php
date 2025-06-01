<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
         // Repository bindings
         $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepository::class);
         $this->app->bind(\App\Repositories\ProjectRepository::class, \App\Repositories\ProjectRepository::class);
         
         // Service bindings
         $this->app->bind(\App\Services\AuthService::class, \App\Services\AuthService::class);
         $this->app->bind(\App\Services\UserService::class, \App\Services\UserService::class);
         $this->app->bind(\App\Services\ProjectService::class, \App\Services\ProjectService::class);
     
 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
    }
}
