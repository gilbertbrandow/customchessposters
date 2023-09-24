<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status', 
        'session_token',
        'cart_id',
        'recipient_id',
        'shipping',
        'shipping_cost',
    ];

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Recipient::class, 'recipient_id');
    }

    public function shippingAlternatives(): HasMany
    {
        return $this->hasMany(ShippingMethod::class);
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function cartItems(): Collection
    {
        return $this->cart->cartItems; 
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function getCartItems(): Builder
    {
        return DB::table('orders')->where('orders.id', $this->id)
            ->join('carts', 'orders.cart_id', '=', 'carts.id')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
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

    public static function getVariants($id)
    {

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

    public function getCartTotalAttribute(): int
    {

        return DB::table('orders')
            ->join('carts', 'carts.id', 'orders.cart_id')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->leftJoin('shipping_methods', 'orders.shipping_method_id', '=', 'shipping_methods.id')
            ->selectRaw('SUM(cart_items.quantity * products.price) + IFNULL(shipping_methods.cost, 0) AS total')
            ->where('orders.id', $this->id)->groupBy('orders.id')->get()->first()->total;
    }

    public function getTotalAttribute(): int
    {
        return DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('shipping_methods', 'orders.shipping_method_id', '=', 'shipping_methods.id')
            ->selectRaw('SUM(order_items.quantity * products.price) + shipping_methods.cost AS total')
            ->where('orders.id', $this->id)->groupBy('orders.id')->get()->first()->total;
    }
}
