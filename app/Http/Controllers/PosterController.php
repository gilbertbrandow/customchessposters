<?php

namespace App\Http\Controllers;

use App\Actions\SavePosterAction;
use App\Models\Poster;
use App\Models\User;
use App\Services\PosterService;
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

    public function save(Request $request, PosterService $service)
    {

        $name = "Temporary poster name"; //Should be able to set in /saved-posters and not in build poster module?

        //Call service class method
        $poster = $service->savePoster($request->posterData, $name, User::find(Auth::id()));

        if ($poster) {
            return redirect()->back()->with('savedSuccess', 'Poster saved!');
        } else {
            return redirect()->back()->with('savedError', 'Something went wrong, please try again later.');
        }
    }

    public function placeOrder(Request $request, PosterService $service)
    {

        //Call service class method to create png
        $poster = $service->createPng($request->posterData, $request->savedName, Auth::id());

        //Call serivce class method to place order at printful
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('PRINTFUL_SK')])->get($this->endpoint . 'stores');

        $content = json_decode($response->body())->result[0];

        dd($content->name);
    }
}
