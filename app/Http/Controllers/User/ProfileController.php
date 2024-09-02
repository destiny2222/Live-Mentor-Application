<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\Share;

class ProfileController extends Controller
{
    public function show(Request $request){
        $username = $request->query('username');
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('/')->with('error', 'User not found');
        }
    
        return view('profile.show', compact('user'));
    }
    
}
