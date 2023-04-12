<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Poster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    public function index () {
        return inertia('GameCollection'); 
    }

    public function show () {

        $user = User::find(Auth::id());
        $posters = $user->savedPostersIdTitle;

        $games = Game::All()->select(['games.id', 'games.name']);

        return inertia('Auth/GameCollection', compact('posters', 'games')); 
    }

    public function create () {
        return inertia('EditGame'); 
    }

    public function update () {
        
    }

    public function destroy () {
        
    }

    
}
