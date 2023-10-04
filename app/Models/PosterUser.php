<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PosterUser extends Model
{
    use HasFactory;

    protected $table = 'poster_user';

    protected $fillable = [
        'user_id',
        'poster_id', 
    ];

    public function poster(): BelongsTo
    {
        return $this->belongsTo(Poster::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
