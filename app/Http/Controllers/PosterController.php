<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PosterController extends Controller
{

    public $endpoint = 'https://api.printful.com/';

    public function show()
    {
        return inertia('CreatePoster');
    }

    public function create(Request $request)
    {

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('PRINTFUL_SK')])->get($this->endpoint . 'stores');

        $content = json_decode($response->body())->result[0];

        dd($content->name);
    }

    public function save(Request $request)
    {

        $poster = new Poster;
        $poster->name = $request->posterData["name"];
        $poster->created_by = Auth::id();
        $poster->theme = $request->posterData["theme"];
        $poster->orientation = $request->posterData["orientation"];
        $poster->pgn = $request->posterData["pgn"];
        $poster->diagram_position = $request->posterData["diagram_position"];
        $poster->fen = $request->posterData["fen"];
        $poster->result = $request->posterData["result"];
        $poster->title = $request->posterData["title"];
        $poster->white_player = $request->posterData["white_player"];
        $poster->black_player = $request->posterData["black_player"];
        $poster->white_rating = $request->posterData["white_rating"];
        $poster->black_rating = $request->posterData["black_rating"];
        $poster->white_title = $request->posterData["white_title"];
        $poster->black_title = $request->posterData["black_title"];
        $poster->when = $request->posterData["when"];
        $poster->where = $request->posterData["where"];
        $poster->save();
    }
}
