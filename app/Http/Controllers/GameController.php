<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GameController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('GameCollection', [
            'games' => fn () => Game::getAll($request)->paginate(8),

            'players' => fn () => DB::table('players')
            ->select('id','name')
            ->orderBy('name', 'asc')
            ->get(),

            'countries' => fn () => DB::table('players')
            ->select('country')
            ->orderBy('country', 'asc')
            ->get()
            ->groupBy('country'),

            'openings' => fn () => DB::table('openings')
            ->select('id', 'eco', 'name')
            ->orderBy('eco', 'asc')
            ->get(),
        ]);
    }

    public function show($id) {

        $game = Game::findOrFail($id)->getFull();

        return Inertia::render('Game', compact('game'));
    }

    public function edit()
    {

        $games = Game::All();

        $user = User::find(Auth::id());

        $posters = $user->posters->pluck('id', 'title');

        $openings = DB::table('openings')
            ->orderBy('eco', 'asc')
            ->get();

        $players = DB::table('players')
            ->orderBy('name', 'asc')
            ->get();

        return Inertia::render('Auth/Game', compact('games', 'posters', 'openings', 'players'));
    }

    public function create(Request $request)
    {

        Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
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
            'description' => $request->description,
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

    public function showGamesData()
    {
        $games = Game::All();

        return Inertia::render('Auth/GamesData', compact('games'));
    }
}
