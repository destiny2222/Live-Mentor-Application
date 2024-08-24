<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LastActivityUser
{
  
    // protected $auth;
 
    // public function __construct(Auth $auth)
    // {
    //     $this->auth = $auth;
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            Log::info('User is authenticated');
            User::where('id', Auth::user()->id)->update([
                'last_seen' => now()
            ]);
        } else {
            Log::info('User is not authenticated');
        }
        return $next($request);
    }
}
