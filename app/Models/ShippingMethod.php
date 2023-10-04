<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'name',
        'desc', 
        'cost',
    ];

    public function alternativeForOrder(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function selectedForOrder(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
