<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Item in a cart/order, product + quantity
class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['product_id', 'order_id', 'quantity'];

    protected $casts = ['quantity' => 'integer'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // The cart/order this item belongs to
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
