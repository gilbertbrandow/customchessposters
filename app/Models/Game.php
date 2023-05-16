<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'poster_id',
        'name',
        'description',
        'date',
        'white_player',
        'black_player',
        'white_rating',
        'world_championship_game',
        'opening_id',
    ];

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function opening()
    {
        return $this->belongsTo(Opening::class);
    }

    public function whitePlayer()
    {
        return $this->belongsTo(Player::class, 'white_player', 'id');
    }

    public function blackPlayer()
    {
        return $this->belongsTo(Player::class, 'black_player', 'id');
    }

    public static function getAll(Request $request)
    {

        //TODO: Take a parameter, maybe $full or $simple and adapt query. For example search highlighting and which fields are selected

        $orderBy = explode('-', $request->input('sort') ?? 'recent-desc');

        return DB::table('games')
            ->join('posters', 'games.poster_id', '=', 'posters.id')
            ->join('openings', 'games.opening_id', '=', 'openings.id')
            ->join('players as white_player', 'games.white_player', '=', 'white_player.id')
            ->join('players as black_player', 'games.black_player', '=', 'black_player.id')
            ->select(
                'games.id as game_id',
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

                $query->selectRaw(
                    '(CASE 
                        WHEN posters.title LIKE ? THEN 1
                        WHEN posters.move_comment LIKE ? THEN 1
                        WHEN posters.when LIKE ? THEN 1 
                        WHEN posters.white_player LIKE ? THEN 1 
                        WHEN posters.black_player LIKE ? THEN 1 
                        WHEN posters.move_comment LIKE ? THEN 1 
                        ELSE 0 END) AS poster_highlight',
                    array_fill(0, 6, "%{$request->search}%")
                );

                $query->selectRaw(
                    '(CASE 
                        WHEN openings.name LIKE ? THEN 1
                        WHEN games.description LIKE ? THEN 1
                        ELSE 0 END) AS read_more_highlight',
                    array_fill(0, 2, "%{$request->search}%")
                );

                $query->selectRaw(
                    '(CASE 
                                WHEN white_player.country LIKE ? THEN 1
                                ELSE 0 END) AS white_country_highlight',
                    ["%{$request->search}%"]
                );

                $query->selectRaw(
                    '(CASE 
                                WHEN black_player.country LIKE ? THEN 1
                                ELSE 0 END) AS black_country_highlight',
                    ["%{$request->search}%"]
                );

                $query->where(function ($query) use ($request) {
                    $query->where('games.name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('games.description', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('games.date', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('posters.title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('posters.move_comment', 'LIKE', '%' . $request->search . '%')
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
            ->when(!str_contains($request->sort, 'rating'),  function ($query) use ($orderBy) {
                $query->orderBy($orderBy[0], $orderBy[1]);
            });
    }
}
