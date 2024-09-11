<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class CustomAuthService{

    public function attempt($credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return true;
        }
        return false;
    }
    // public function attempt(array $credentials, bool $remember = false)
    // {
    //     return Auth::attempt($credentials, $remember);
    // }

    public function user()
    {
        return Auth::user();
    }

    public function check()
    {
        return Auth::check();
    }

    public function logout()
    {
        Auth::logout();
    }

    public function login(){

        return Auth::login();
    }
}