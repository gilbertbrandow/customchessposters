<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterVariant;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PosterController extends Controller
{

    public function index()
    {
        return Inertia::render('CreatePoster');
    }

    public function show($id)
    {
        $editPoster = Poster::findOrFail($id);

        return Inertia::render('CreatePoster', compact('editPoster'));
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

    public function createPng(int $posterId, int $variantId)
    {
        $poster = Poster::findOrFail($posterId);
        $variant = PosterVariant::findOrFail($variantId);

        $width = intval($variant->posterSize->width / $variant->posterSize->height * $height = 8550);

        return (new PosterService())->generatePNG($poster, $width, $height);
    }
}
