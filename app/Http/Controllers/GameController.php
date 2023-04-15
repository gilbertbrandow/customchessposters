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
        return inertia('Game');
    }

    public function show()
    {

        $games = Game::All();

        $user = User::where('admin', true)->first();

        $posters = $user->savedPostersIdTitle;

        $openings = DB::table('openings')
            ->orderBy('eco', 'asc')
            ->get();

        $players = DB::table('players')
            ->orderBy('name', 'asc')
            ->get();

        return inertia('Auth/Game', compact('games', 'posters', 'openings', 'players'));
    }

    public function create(Request $request)
    {

        Game::create([
            'name' => $request->name, 
            'when' => $request->when, 
            'poster_id' => $request->poster_id, 
            'black_player' => $request->black_player, 
            'white_player' => $request->white_player, 
            'world_championship_game' => $request->world_championship_game, 
            'opening_id' => $request->opening_id, 
        ]); 

        return redirect()->back()->with('success', 'Game successfully created');
    }

    public function update(Request $request)
    {
        Game::find($request->id)->update([
            'name' => $request->name, 
            'when' => $request->when, 
            'poster_id' => $request->poster_id, 
            'black_player' => $request->black_player, 
            'white_player' => $request->white_player, 
            'world_championship_game' => $request->world_championship_game, 
            'opening_id' => $request->opening_id, 
        ]);

        return redirect()->back()->with('success', 'Game successfully updated');
    }

    public function destroy(Request $request)
    {
        Game::find($request->id)->delete();
        return redirect()->back()->with('success', 'Game successfully deleted');
    }
}
