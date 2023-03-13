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
        'pgn',
        'diagram_position',
        'fen',
        'title',
        'white_name',
        'black_name',
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

    public function saved_posters()
    {
        return $this->belongsToMany(User::class);
    }
}
