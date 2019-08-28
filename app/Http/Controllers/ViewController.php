<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Http\Request;
use JavaScript;

class ViewController extends Controller
{
    public function index()
    {
        $url = config('app.url');

        JavaScript::put([
            'app' => [
                'url' => $url,
            ],
        ]);


        return view('index');
    }

    public function movies()
    {
        $movies = Movie::with('genres')->get();
        $genres = Genre::all();
        $tmdbImageUrl = config('urls.api.tmdb.image');

        return view('movies', compact($movies, $genres, $tmdbImageUrl));
    }

    public function wiserei(Request $request)
    {
        $authenticated = $request->input('password') === 'robert';
        $airtableApiKey = config('services.airtable.apiKey');
        $airtableWisereiBase = config('services.airtable.wiserei.base');

        return view('wiserei', compact('authenticated', 'airtableApiKey', 'airtableWisereiBase'));
    }
}
