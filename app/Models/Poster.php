<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Poster extends Model
{
    use HasFactory;

    protected $table = 'posters';

    protected $fillable = [
        'theme_id',
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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function game(): HasOne
    {
        return $this->hasOne(Game::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
