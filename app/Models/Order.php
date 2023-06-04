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

    public function cart() {

        return $this->belongsTo(Cart::class, 'cart_id');
 
     }
 

    public static function getCartItems($orderId) {
        return DB::table('orders')->where('orders.id', $orderId)
        ->join('carts', 'orders.cart_id', '=', 'carts.id')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'products.id', '=', 'cart_items.product_id')
        ->join('poster_variants', 'poster_variants.id', '=', 'products.poster_variant_id')
        ->join('posters', 'posters.id', '=', 'products.poster_id')
        ->select(
            'carts.id as cartId',
            'cart_items.id as itemId',
            'cart_items.quantity',
            'products.price',
            'products.name',
            'products.type',
            'poster_variants.height',
            'poster_variants.width',
            'poster_variants.description',
            'posters.id',
            'posters.theme',
            'posters.orientation',
            'posters.starting_position',
            'posters.pgn',
            'posters.diagram_position',
            'posters.move_comment',
            'posters.fen',
            'posters.result',
            'posters.title',
            'posters.white_player',
            'posters.black_player',
            'posters.white_rating',
            'posters.black_rating',
            'posters.white_title',
            'posters.black_title',
            'posters.when',
            'posters.where',
        );
    }

    public static function getVariants($id) {

        return DB::table('orders')->where('orders.id', $id)
        ->join('carts', 'cart_id', '=', 'carts.id')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'products.id', '=', 'cart_items.product_id')
        ->join('poster_variants', 'poster_variants.id', '=', 'products.poster_variant_id')
        ->select(
            'poster_variants.variant_id as variant_id',
            'cart_items.quantity as quantity',
        );
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
