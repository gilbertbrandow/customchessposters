<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 
        'product_id',
        'quantity',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
