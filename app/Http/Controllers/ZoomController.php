<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ZoomController extends Controller
{
    public function redirectToZoom()
    {
        $url = 'https://zoom.us/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => config('services.zoom.ZOOM_CLIENT_ID'),
            'redirect_uri' => config('services.zoom.redirect_uri')
        ]);

        return redirect($url);
    }

    public function handleZoomCallback(Request $request)
    {
        $response = Http::post('https://zoom.us/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => config('services.zoom.redirect_uri'),
        ])->withBasicAuth(config('services.zoom.ZOOM_CLIENT_ID'), config('services.zoom.ZOOM_CLIENT_SECRET'));

        $token = $response->json();

        // Store the token in the session or database
        Session::put('zoom_access_token', $token['access_token']);
        Session::put('zoom_refresh_token', $token['refresh_token']);

        return redirect()->route('home')->with('success', 'Zoom account connected successfully!');
    }

    public function refreshZoomToken()
    {
        $response = Http::post('https://zoom.us/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => Session::get('zoom_refresh_token'),
        ])->withBasicAuth(config('services.zoom.ZOOM_CLIENT_ID'), config('services.zoom.ZOOM_CLIENT_SECRET'));

        $token = $response->json();

        Session::put('zoom_access_token', $token['access_token']);
        Session::put('zoom_refresh_token', $token['refresh_token']);

        return $token['access_token'];
    }
}
