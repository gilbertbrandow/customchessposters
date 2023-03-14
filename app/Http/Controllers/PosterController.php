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

        $data = $request->posterData;
        $data["pgn"] = $data["pgn"] ? $data["pgn"] : "";
        $data['created_by']=Auth::id();
        $poster = Poster::create($data);
        $poster->users_saved()->attach(Auth::id());
        return redirect()->back()->with('savedSuccess', 'Poster saved!');

    }
}
