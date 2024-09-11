<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Facades\CustomAuthFacade;
use App\Services\CustomAuthService;    // dependency injection

class AuthController extends Controller
{

    protected $authService;

    // Inject CustomAuthService
    public function __construct(CustomAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
         
        if($this->authService->attempt($credentials)){
            session()->put('custom_message', 'You have logged in successfully!');
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
        $credentials = $request->validate([
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
        // if (CustomAuthFacade::attempt($credentials)) {
        if ($this->authService->attempt($credentials)) {
            session()->put('custom_message', 'Welcome! Your account has been created successfully.');
            
        
            $this->authService->login($user);
            return redirect('home')->withSuccess('Registration successful. Logged in!');
        }

        return redirect('register')->withError('Login Failed');
    }

    public function home(){
        return view('home');
    }


    public function logout(){
        
        session()->flush();
        $this->authService->logout();
        
        return redirect('')->withsuccess('Logged out successfully');
    }
}
