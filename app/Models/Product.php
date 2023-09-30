<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'price',
        'name',
        'type',
        'poster_id',
        'poster_variant_id',
    ];

    public function poster(): BelongsTo
    {
        return $this->belongsTo(Poster::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(PosterVariant::class, 'poster_variant_id', 'id');
    }
}
