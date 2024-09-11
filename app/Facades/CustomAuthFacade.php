<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;
use App\Services\CustomAuthService;
class CustomAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomAuthService::class;
    }
}