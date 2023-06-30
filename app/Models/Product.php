<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function variant()
    {
        return $this->belongsTo(PosterVariant::class, 'poster_variant_id', 'id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class, 'cart_items');
    }

}
