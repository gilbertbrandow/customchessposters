<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;
use App\Models\Product;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PosterController extends Controller
{

    public $endpoint = 'https://api.printful.com/';

    public function index()
    {
        return Inertia::render('CreatePoster');
    }

    public function show($id)
    {
        $editPoster = Poster::find($id);

        return Inertia::render('CreatePoster', compact('editPoster'));
    }

    public function create(Request $request) {

        return (new PosterService())->create($request->posterData);
    }

    public function update(Request $request) {

        $poster = (new PosterService())->update($request->posterData, Auth::id(), $request->session()->get('_token'));

        return redirect('/edit-poster/' . $poster->id)->with('savedSuccess', 'Poster updated successfully!');
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
