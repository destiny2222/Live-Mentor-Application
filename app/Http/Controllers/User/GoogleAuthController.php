<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{


    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try{
            $google_user = Socialite::driver('google')->user();
            $existingUser = User::where('email', $google_user->email)->first();
            // dd($user);
            if ($existingUser) {
                Auth::login($existingUser);
                return redirect()->intended('dashboard');
            } else {
    
             $new_user =  User::create([
                    'name'          => $google_user->get,
                    'email'         => $google_user->email,
                    'password'      => Hash::make(Str::random(8)),
                    'provider_name' => 'google',
                    'provider_id'   => $google_user->id,
                    'provider_token' => $google_user->token,
                    'email_verified_at'=> now(),
                ]);
    
                Auth::login($new_user);
                return redirect()->intended('dashboard');
            }
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error','Something went wrong');
        }
    }
}
