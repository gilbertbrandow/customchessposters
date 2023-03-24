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

        //Format data
        $data = $request->posterData;
        $data["pgn"] = $data["pgn"] ? $data["pgn"] : "";


        //TODO: How to handle if poster is being edited? i.e id is present and created_by == Auth::id()
        if ($data['id'] && Poster::find($data['id'])->get(['created_by']) == Auth::id()) {

            //Get and edit poster instead
            Poster::find($request->id)->update($data)->save();
        } else {

            //Check if any poster exists that matches all the request data except id && created_by
            unset($data['id']);
            $poster = Poster::where($data)->first();

            if (!$poster) {
                //No match create new poster 
                $data['created_by'] = Auth::id();
                $poster = Poster::create($data);
            }

            //Attach a relationship with name 
            $poster->users_saved()->attach([Auth::id() => ['name' => 'My saved poster 2']]);
            return redirect()->back()->with('savedSuccess', 'Poster saved!');
        }
    }
}
