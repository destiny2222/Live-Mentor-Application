<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
     }
     
 
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::ADMIN);
    }
 
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();  // this invalidates the user's session
         $request->session()->regenerateToken();//this regenerates the csrf token
         return redirect()->to(RouteServiceProvider::WELCOME);
     }
 }