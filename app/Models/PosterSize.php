<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PosterSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'width', 
        'height', 
    ]; 

    public function posterVariants(): HasMany
    {
        return $this->hasMany(PosterVariant::class);
    }
}
