<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;
use App\Models\User;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedPosterController extends Controller

{
    public function index()
    {
        $user = User::find(Auth::id());
        $posters = $user->posters;
        return inertia('Auth/SavedPosters', compact('posters'));
    }

    public function create(Request $request)
    {
        $poster = $request->posterData['id'] ?
            (new PosterService())->update($request->posterData, Auth::id(), $request->session()->get('_token'))
            : (new PosterService())->create($request->posterData);

        User::find(Auth::id())->posters()->attach($poster->id);

        return redirect()->back()->with('savedSuccess', 'Poster saved!');
    }

    public function destroy(Request $request)
    {
        $user = User::find(Auth::id());

        $user->posters()->detach($request->deleteSavedPosterId);

        $poster = Poster::find($request->deleteSavedPosterId);

        //Delete poster if has no relationships with users or is a Game
        if (!$poster->usersSaved()->count() && !Game::where('poster_id', $poster->id)) $poster->delete();

        return redirect()->back()->with('savedSuccess', 'Poster was removed');
    }
}
