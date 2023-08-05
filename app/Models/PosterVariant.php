<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterVariant extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function posterSize()
    {
        return $this->belongsTo(PosterSize::class);
    }

    public function posterFrame()
    {
        return $this->belongsTo(PosterFrame::class);
    }
}
