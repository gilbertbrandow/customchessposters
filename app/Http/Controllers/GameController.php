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
        
        $order = explode('-', $request->input('sort') ?? 'recent-desc');

        $players = DB::table('players')
            ->select('id','name', 'country')
            ->orderBy('country', 'asc')
            ->get()
            ->groupBy('country');

        $openings = DB::table('openings')
        ->select('id', 'eco', 'name')
        ->orderBy('eco', 'asc')
        ->get();

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
                'games.opening_id',
                'games.white_player',
                'games.white_player',
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
            ->when($request->search !== null, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('games.name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('games.description', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('games.date', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('posters.title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('posters.when', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('posters.where', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('openings.name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('openings.eco', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('white_player.name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('black_player.name', 'LIKE', '%' . $request->search . '%') 
                        ->orWhere('white_player.country', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('black_player.country', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->when($request->dateFrom !== null, function ($query) use ($request) {
                $query->where('games.date', '>=', $request->dateFrom);
            })
            ->when($request->dateTo !== null, function ($query) use ($request) {
                $query->where('games.date', '<=', $request->dateTo);
            })
            ->when($request->result !== null, function ($query) use ($request) {
                $query->where('posters.result', '=', $request->result);
            })
            ->when($request->wcc !== null, function ($query) use ($request) {
                $query->where('games.world_championship_game', '=', $request->wcc);
            })
            ->when($request->opening !== null, function ($query) use ($request) {
                $query->where('games.opening_id', '=', $request->opening);
            })
            ->when($request->country, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('white_player.country', '=', $request->country)
                        ->orWhere('black_player.country', '=', $request->country);
                });
            })
            ->when($request->player, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('games.white_player', '=', $request->player)
                        ->orWhere('games.black_player', '=', $request->player);
                });
            })
            ->when($request->titles, function ($query) use ($request) {
                $query->when(str_contains($request->titles, 'GM'), function ($query) use ($request) {
                    $query->where(function ($query) {
                        $query->where('posters.white_title', '=', 'GM')
                            ->orWhere('posters.black_title', '=', 'GM');
                    });
                })->when(str_contains($request->titles, 'masters'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereNotNull('posters.white_title')
                            ->whereNotNull('posters.black_title');
                    });
                })->when(str_contains($request->titles, 'master'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereNotNull('posters.white_title')
                            ->orWhereNotNull('posters.black_title');
                    });
                })->when(str_contains($request->titles, 'non'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereNull('posters.white_title')
                            ->whereNotNull('posters.black_title');
                    });
                })->when(str_contains($request->titles, 'not'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereNull('posters.white_title')
                            ->orWhereNull('posters.black_title');
                    });
                });
            })
            ->when(str_contains($request->sort, 'rating'),  function ($query) use ($request) {
                $query->orderByRaw('(`posters`.`white_rating` + `posters`.`black_rating`) ' . explode('-', $request->input('sort'))[1]);
            })
            ->when(!str_contains($request->sort, 'rating'),  function ($query) use ($order) {
                $query->orderBy($order[0], $order[1]);
            })
            ->paginate(2);

        return inertia('GameCollection', compact('games', 'players', 'openings'));
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
