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

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'cart_items');
    }

    public static function getFullCart($token, $id) {

        return DB::table('carts')->where('session_token', $token)
        ->when($id !== null, function ($query) use ($id) { 
            $query->orWhere('user_id', $id);
        })->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->join('sizes', 'sizes.id', '=', 'products.size_id')
            ->join('posters', 'posters.id', '=', 'products.poster_id')
            ->select(    
            'carts.id as cartId',  
            'cart_items.id as itemId', 
            'cart_items.quantity',
            'products.price',
            'products.name',
            'products.type',
            'sizes.height',
            'sizes.width',
            'sizes.description',
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

    public static function hasPosterNotUser($posterId, $user) {

        return DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->where('carts.user_id', '!=', $user[0])
            ->where('carts.session_token', '!=', $user[1])
            ->where('products.poster_id', '=', $posterId);
    }

}
