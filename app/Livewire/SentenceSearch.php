<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SentenceSearch extends Component
{
    public $sentence;
    public $songs = [];

    public function searchSongs()
    {
        $words = explode(' ', $this->sentence);
        $token = Session::get('spotify_access_token');

        $this->songs = [];

        foreach ($words as $word) {
            $response = Http::withToken($token)->get('https://api.spotify.com/v1/search', [
                'q' => $word,
                'type' => 'track',
                'limit' => 2
            ]);

            $data = $response->json();

            if (!empty($data['tracks']['items'])) {
                $track = $data['tracks']['items'][0];
                $this->songs[] = [
                    'name' => $track['name'],
                    'artist' => $track['artists'][0]['name'],
                    'url' => $track['external_urls']['spotify']
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.sentence-search');
    }
}
