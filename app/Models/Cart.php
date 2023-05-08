<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id', 
        'session_token',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cartItems(): HasMany {
        return $this->hasMany(CartItem::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'cart_items');
    }

    public static function getFullCart($token, $id) {

        return DB::table('carts')->where('session_token', $token)->orWhere('user_id', $id)
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->join('sizes', 'sizes.id', '=', 'products.size_id')
            ->join('posters', 'posters.id', '=', 'products.poster_id');
    }

}
