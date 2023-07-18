<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function poster() {
        return $this->hasMany(Poster::class); 
    }
}
