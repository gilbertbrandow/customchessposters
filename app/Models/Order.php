<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'payment_intent',
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
