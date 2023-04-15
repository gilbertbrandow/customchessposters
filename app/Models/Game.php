<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'poster_id',
        'name',
        'when',
        'white_player',
        'black_player',
        'white_rating',
        'world_championship_game',
        'opening_id',
    ];
}
