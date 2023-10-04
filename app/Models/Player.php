<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'name',
        'country',
        'computer',
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class); 
    }
}
