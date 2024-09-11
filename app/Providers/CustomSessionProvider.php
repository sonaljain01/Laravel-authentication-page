<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
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
        Session::extends('custom_driver', function ($app) {
            return new CustomSessionHandler();
        });
    }
}
