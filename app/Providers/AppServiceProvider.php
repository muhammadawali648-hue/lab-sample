<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
use App\Providers\UsernameAuthProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('auth', function ($app) {
            return new \Illuminate\Auth\AuthManager($app);
        });

        $this->app->bind('auth.provider.username', function ($app, $config) {
            return new UsernameAuthProvider($app['hash'], $config['model']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
