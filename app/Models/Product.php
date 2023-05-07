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
        'size_id',
    ];

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

}
