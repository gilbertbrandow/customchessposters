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

class PosterController extends Controller
{

    public $endpoint = 'https://api.printful.com/';

    public function index()
    {
        return inertia('CreatePoster');
    }

    public function show($id)
    {
        $editPoster = Poster::find($id);

        return inertia('CreatePoster', compact('editPoster'));
    }

    public function create($posterData) {

        //Hit this method when trying to create a poster that has no known id in db
        $posterData['pgn'] = $posterData['pgn'] ?? '';

         //Search in DB for exact record
         $poster = Poster::firstOrCreate($posterData);

         return $poster->id;
    }

    public function update($posterData, Request $request) {

        //Hit this method when trying to update a poster with id that corresponds with a record in db
        $posterData['pgn'] = $posterData['pgn'] ?? '';
        $id = array_shift($posterData);

         //Search in DB for exact record, if match. Simply use that id
         $poster = Poster::where($posterData)->first();

         if(!$poster) {

            //Check if the id of the poster has any relationship with either a cart, saved user or Game.
            if (
                Game::where('poster_id', '=', $id)
                || PosterUser::where('poster_id', '=', $id)->where('user_id', '!=', Auth::id())
                || Cart::hasProductNotUser($id, [Auth::id(), $request->session->get('_token')])->count()
            ) {
                //No relationship found to any user except for current
                $poster = Poster::create($posterData);

            } else {
                $poster->update($posterData);
            }
         }

         //Return id of poster
         return $poster->id;

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
