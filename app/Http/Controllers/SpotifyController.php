<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SpotifyController extends Controller
{
    //
    public function redirectToSpotify()
    {
        $query = http_build_query([
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'response_type' => 'code',
            'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
            'scope' => 'playlist-modify-public',
        ]);

        return redirect("https://accounts.spotify.com/authorize?$query");
    }

    public function handleSpotifyCallback(Request $request)
    {
        $code = $request->get('code');

        $response = Http::asForm()->withBasicAuth(
            env('SPOTIFY_CLIENT_ID'),
            env('SPOTIFY_CLIENT_SECRET')
        )->post('https://accounts.spotify.com/api/token', [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
                ]);

        $accessToken = $response->json()['access_token'];
        Session::put('spotify_access_token', $accessToken);

        return redirect('/dashboard');
    }
}
