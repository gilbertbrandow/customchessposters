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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_items');
    }

    public static function getTotalAmount($token, $id)
    {

        //Find all cart items, find the product prices and multiply the prices with quantity and add together
        return DB::table('carts')->where('carts.session_token', $token)
            ->when($id !== null, function ($query) use ($id) {
                $query->orWhere('carts.user_id', $id);
            })->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->selectRaw('SUM(products.price * cart_items.quantity) AS total');
    }


    public static function getFullCart($token, $id)
    {

        return DB::table('carts')->where('session_token', $token)
            ->when($id !== null, function ($query) use ($id) {
                $query->orWhere('user_id', $id);
            })->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->join('poster_variants', 'poster_variants.id', '=', 'products.poster_variant_id')
            ->join('poster_sizes', 'poster_sizes.id', '=', 'poster_variants.poster_size_id')
            ->join('poster_frames', 'poster_frames.id', '=', 'poster_variants.poster_frame_id', 'left')
            ->join('posters', 'posters.id', '=', 'products.poster_id')
            ->select(
                'carts.id as cartId',
                'cart_items.id as itemId',
                'cart_items.quantity',
                'products.price',
                'products.name',
                'products.type',
                'poster_sizes.height',
                'poster_sizes.width',
                'poster_frames.name as frame',
                'poster_frames.image',
                'posters.id',
                'posters.theme_id',
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

    public static function hasPosterNotUser($posterId, $user)
    {

        return DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->where('carts.user_id', '!=', $user[0])
            ->where('carts.session_token', '!=', $user[1])
            ->where('products.poster_id', '=', $posterId);
    }

    public static function getVariants($token, $id)
    {

        return DB::table('carts')->where('session_token', $token)
            ->when($id !== null, function ($query) use ($id) {
                $query->orWhere('user_id', $id);
            })->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->join('poster_variants', 'poster_variants.id', '=', 'products.poster_variant_id')
            ->select(
                'poster_variants.variant_id as variant_id',
                'cart_items.quantity as quantity',
            );
    }
}
