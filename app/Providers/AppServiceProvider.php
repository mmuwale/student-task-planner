<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // If you need to force HTTPS in production
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        
        // Simple gate for authenticated users
        Gate::define('access-app', function ($user) {
            return $user !== null;
        });
    }
}
