<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'poster_id',
        'name',
        'description', 
        'when',
        'white_player',
        'black_player',
        'white_rating',
        'world_championship_game',
        'opening_id',
    ];

    public function poster() {
        return $this->belongsTo(Poster::class);
    }

    public function opening() {
        return $this->belongsTo(Opening::class);
    }
}
