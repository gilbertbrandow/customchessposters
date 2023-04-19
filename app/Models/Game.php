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
}
