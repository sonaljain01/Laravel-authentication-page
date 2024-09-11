<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Services\CustomAuthService;
class CustomAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('customauth', function(){
            return new CustomAuthService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
