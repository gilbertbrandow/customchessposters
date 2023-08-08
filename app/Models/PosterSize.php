<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'width', 
        'height', 
    ]; 

    public function posterVariants()
    {
        return $this->hasMany(PosterVariant::class);
    }
}