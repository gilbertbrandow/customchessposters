<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'name',
        'desc', 
        'cost',
    ];

    public function order() {
        $this->belongsTo(Order::class);
    }
}
