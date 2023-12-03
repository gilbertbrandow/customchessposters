<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 
        'phone',
        'user_id', 
        'session_token',
        'country_code',
        'country',
        'state_code',
        'name',
        'address1',
        'address2',
        'zip',
        'city',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
