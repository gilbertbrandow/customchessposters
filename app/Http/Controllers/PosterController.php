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

    public function show () {
        return inertia('CreatePoster'); 
    }

    public function create (Request $request) {

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('PRINTFUL_SK')])->get($this->endpoint . 'stores');

        $content = json_decode($response->body())->result[0];

        dd($content->name);
    }

    public function save (Request $request) {

        $poster = new Poster;
        $poster->name = $request->name;
        $poster->theme = $request->posterData['themeId'];
        $poster->orientation = $request->posterData['orientation'];
        $poster->pgn = $request->posterData['gamePgn'];
        $poster->diagram_position = $request->posterData['diagramPosition'];
        $poster->title = $request->posterData['gameMeta']['title'];
        $poster->white_name = $request->posterData['gameMeta']['white']['name'];
        $poster->white_rating = $request->posterData['gameMeta']['white']['rating'];
        $poster->white_title = $request->posterData['gameMeta']['white']['title'];
        $poster->black_name = $request->posterData['gameMeta']['black']['name'];
        $poster->black_rating = $request->posterData['gameMeta']['black']['rating'];
        $poster->black_title = $request->posterData['gameMeta']['black']['title'];
        $poster->when = $request->posterData['gameMeta']['when'];
        $poster->where = $request->posterData['gameMeta']['where'];
        $poster->user_id = Auth::id();
        $poster->save();
    }
}