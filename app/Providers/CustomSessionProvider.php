<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Services\CustomSessionHandler;
use App\Services\SessionHandlerInterface;
use App\Providers\AuthServiceProvider;
class CustomSessionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SessionHandlerInterface::class, CustomSessionHandler::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
