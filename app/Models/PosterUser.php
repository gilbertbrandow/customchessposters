<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterUser extends Model
{
    use HasFactory;

    protected $table = 'poster_user';

    protected $fillable = [
        'user_id',
        'poster_id', 
    ];

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
