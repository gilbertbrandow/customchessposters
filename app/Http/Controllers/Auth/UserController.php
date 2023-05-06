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
    public function index()
    {
        return inertia('Auth/Account');
    }

    public function postersData()
    {
        $user = User::find(Auth::id());
        $posters = $user->posters;

        return inertia('Auth/PosterData', compact('posters'));
    }
}
