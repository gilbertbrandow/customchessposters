<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 
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

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
