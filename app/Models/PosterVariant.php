<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PosterVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'poster_size_id',
        'poster_frame_id',
        'description',
        'price',
        'variant_id',
    ];

    public function posterSize(): BelongsTo
    {
        return $this->belongsTo(PosterSize::class);
    }

    public function posterFrame(): BelongsTo
    {
        return $this->belongsTo(PosterFrame::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
