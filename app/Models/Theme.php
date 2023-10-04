<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'font_regular',
        'font_italic',
        'background', 
        'color', 
    ];

    public function poster(): HasMany
    {
        return $this->hasMany(Poster::class); 
    }
}
