<?php

use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/spotify/login', [SpotifyController::class, 'redirectToSpotify'])->name('spotify.login');
    Route::get('/spotify/callback', [SpotifyController::class, 'handleSpotifyCallback']);


});
