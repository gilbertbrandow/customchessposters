<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opening extends Model
{
    use HasFactory;

    protected $table = 'openings';

    protected $fillable = [
        'eco',
        'name',
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class); 
    }
}
