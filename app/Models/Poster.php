<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $table = 'posters';

    protected $fillable = [
        'theme',
        'orientation',
        'starting_position',
        'pgn',
        'diagram_position',
        'move_comment',
        'fen',
        'result',
        'title',
        'white_player',
        'black_player',
        'white_rating',
        'black_rating',
        'white_title',
        'black_title',
        'when',
        'where',
    ];

    
    public function usersSaved()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function theme() {
        return $this->belongsTo(Theme::class); 
    }
}
