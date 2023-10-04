<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PosterFrame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'image', 
    ]; 

    public function posterVariants(): HasMany
    {
        return $this->hasMany(PosterVariant::class);
    }
}
