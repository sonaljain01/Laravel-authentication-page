<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use App\Models\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(Connection::class, function (Application $app) {
            return new Connection(config('AuthService'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Auth::extend('custom', function ($app) {
            return new class {
                public function attempt(array $credentials)
                {
                    $user = User::where('email', $credentials['email'])->first();
                    
                    if ($user && Hash::check($credentials['password'], $user->password)) {
                        Auth::login($user);

                        return true;
                    }
                    return false;
                }
            };
        });

        // Custom registration method
        app()->bind('auth.register', function () {
            return new class {
                public function register(array $data)
                {
                    return User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                    ]);
                }
            };
        });

        // Custom logout method
        app()->bind('auth.logout', function () {
            return new class {
                public function logout()
                {
                    Auth::logout();
                    
                }
            };
        });
    }
}
