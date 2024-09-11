<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use validator;
class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
         
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('home');
        }
        return redirect('login')->withError('Invalid Credentials');
    }
    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|string|min:8|',
        ]);

        //Save in users table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            
        ]);

        // login user after registration
        if (Auth::attempt($request->only('email', 'password'))) {
            

            return redirect('home')->withSuccess('Registration successful. Logged in!');
        }

        return redirect('register')->withError('Login Failed');
    }

    public function home(){
        return view('home');
    }


    public function logout(){
        
        \Session::flush();
        Auth::logout();
        
        return redirect('');
    }
}
