<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Poster;
use App\Services\OrderService;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PosterController extends Controller
{

    public function index()
    {
        return Inertia::render('CreatePoster');
    }

    public function show($id)
    {
        $poster = Poster::find($id);

        return Inertia::render('CreatePoster', compact('poster'));
    }

    public function create(Request $request)
    {

        return (new PosterService())->create($request->posterData);
    }

    public function update(Request $request)
    {

        $poster = (new PosterService())->update($request->posterData, Auth::id(), $request->session()->get('_token'));

        return redirect('/edit-poster/' . $poster->id)->with('savedSuccess', 'Poster updated successfully!');
    }

    public function single($id)
    {

        $poster = Poster::find($id);

        return (new PosterService())->generatePNG($poster);

        return (new OrderService(Order::first()))->sendOrderToPrintful();
    }
}
