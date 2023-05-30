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
        'recipient_id',
        'shipping',
        'shipping_cost',
    ]; 

    public function shippingAddress() {

       return $this->belongsTo(Recipient::class, 'recipient_id');

    }

    public static function totalAmount($id) {

        return DB::table('orders')
        ->join('carts', 'carts.id', 'orders.cart_id')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'products.id', '=', 'cart_items.product_id')
        ->selectRaw('SUM(cart_items.quantity * products.price) + shipping_cost AS total')
        ->where('orders.id', $id)->groupBy('orders.id');
     }
}
