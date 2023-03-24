<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $table = 'posters';

    protected $fillable = [
        'name',
        'created_by',
        'theme',
        'orientation',
        'starting_position',
        'pgn',
        'diagram_position',
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

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users_saved()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
