<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Opening;
use App\Models\Player;
use App\Models\Poster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{

    public function index()
    {
        return inertia('GameCollection');
    }

    public function show()
    {

        $user = User::where('admin', true)->first();

        $posters = $user->savedPostersIdTitle;

        $openings = DB::table('openings')
            ->orderBy('eco', 'asc')
            ->get();

        $players = DB::table('players')
            ->orderBy('name', 'asc')
            ->get();

        $games = Game::All();

        return inertia('Auth/GameCollection', compact('posters', 'openings', 'players'));
    }

    public function create()
    {
        return inertia('EditGame');
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
