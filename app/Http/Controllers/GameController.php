<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{

    public function index(Request $request)
    {
        
        $order = explode('-', $request->input('sort') ?? 'date-desc');


        $params = []; 

        if($request->input('wcc')) array_push($params, ['games.world_championship_game', '=', 1]);


        $players = DB::table('players')
            ->select('id','name', 'country')
            ->get()
            ->groupBy('country');

        $games = DB::table('games')
            ->join('posters', 'games.poster_id', '=', 'posters.id')
            ->join('openings', 'games.opening_id', '=', 'openings.id')
            ->join('players as white_player', 'games.white_player', '=', 'white_player.id')
            ->join('players as black_player', 'games.black_player', '=', 'black_player.id')
            ->select(
                'games.name',
                'games.description',
                'games.date',
                'games.world_championship_game',
                'games.created_at',
                'games.updated_at as recent',
                'posters.id',
                'posters.theme',
                'posters.orientation',
                'posters.starting_position',
                'posters.pgn',
                'posters.diagram_position',
                'posters.move_comment',
                'posters.fen',
                'posters.result',
                'posters.title',
                'posters.white_player',
                'posters.black_player',
                'posters.white_rating',
                'posters.black_rating',
                'posters.white_title',
                'posters.black_title',
                'posters.when',
                'posters.where',
                'openings.name as opening_name',
                'openings.eco as opening_eco',
                'white_player.name AS white_name',
                'white_player.country AS white_country',
                'black_player.name AS black_name',
                'black_player.country AS black_country',
            )
            ->orderBy($order[0], $order[1])
            ->where($params)
            ->paginate(2);

        return inertia('GameCollection', compact('games', 'players'));
    }

    public function show()
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

        return inertia('Auth/Game', compact('games', 'posters', 'openings', 'players'));
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

        return inertia('Auth/GamesData', compact('games'));
    }
}
