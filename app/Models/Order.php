<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'session_token',
        'cart_id', 
        'shipping_addresses_id',
        'shipping',
        'shipping_cost',
    ]; 

    public function shippingAddress() {

       return $this->belongsTo(ShippingAddress::class, 'shipping_addresses_id');

    }
}
