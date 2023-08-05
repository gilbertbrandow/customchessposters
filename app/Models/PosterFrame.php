<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterFrame extends Model
{
    use HasFactory;

    public function posterVariants()
    {
        return $this->hasMany(PosterVariant::class);
    }
}
