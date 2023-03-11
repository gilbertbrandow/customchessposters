<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $table = 'posters';

    public function created_by()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function saved_posters()
    {
        return $this->belongsToMany(User::class);
    }
}
