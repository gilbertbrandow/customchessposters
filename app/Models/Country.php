<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'region',
    ];

    protected $table = 'countries';

    public function states(): HasMany
    {
        return $this->hasMany(State::class); 
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class); 
    }
}
