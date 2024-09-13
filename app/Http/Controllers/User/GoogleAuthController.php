<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;


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
                return redirect('dashboard');
            } else {
                $new_user = new User();
                $new_user->name = $google_user->name;
                $new_user->email = $google_user->email;
                $new_user->provider_name = 'google';
                $new_user->provider_id   = $google_user->id;
                $new_user->password = Hash::make(Str::random(8));
                $new_user->provider_token = $google_user->token;
                $new_user->email_verified_at = Carbon::now();
                $new_user->save();
                // $new_user =  User::updateOrCreate([
                //     'name'          => $google_user->name,
                //     ''         => $google_user->email,
                //     'password'      => 
                //     'provider_name' => 'google',
                    
                //     'provider_token' => $google_user->token,
                //     ''=> ,
                // ]);
    
                Auth::login($new_user);
                Log::info('Current time: ' . Carbon::now());
                return redirect('dashboard');
            }
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error','Something went wrong');
        }
    }
}
