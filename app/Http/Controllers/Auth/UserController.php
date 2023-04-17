<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Poster;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function account()
    {
        return inertia('Auth/Account');
    }

    public function savedPosters()
    {
        $user = User::find(Auth::id());
        $posters = $user->savedPosters;
        return inertia('Auth/SavedPosters', compact('posters'));
    }

    public function savedPostersData()
    {
        $user = User::find(Auth::id());
        $posters = $user->savedPosters;

        return inertia('Auth/PosterData', compact('posters'));
    }

    public function removeSavedPoster(Request $request)
    {
        $user = User::find(Auth::id());

        $user->savedPosters()->detach($request->deleteSavedPosterId);

        $poster = Poster::find($request->deleteSavedPosterId);

        //Delete poster if has no relationships with users.
        if (!$poster->usersSaved()->count() && !Game::where('poster_id', $poster->id)) $poster->delete();

        return redirect()->back()->with('savedSuccess', 'Poster was removed');
    }
}
