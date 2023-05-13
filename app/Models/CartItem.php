<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id', 
        'product_id',
        'quantity',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }


    public static function belongsToUser($id, $token){
        return DB::table('cart_items')
        ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
        ->where('carts.session_token', $token)
        ->when($id !== null, function ($query) use ($id) { 
            $query->orWhere('carts.user_id', $id);
        });
    }
}
