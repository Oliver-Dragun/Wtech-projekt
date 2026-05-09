<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Handles both cart and order based on if status_id is set, null means cart, not null means order
class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'email',
        'phone_number',
        'sum',
        'shipping_address_id',
        'shipping_method_id',
        'date',
        'status_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Address used for this order
    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    // Returns the status, null if it is a cart
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    // Returns items in this order -> product + quantity for each
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Returns current cart
    public function scopeActiveCart($query)
    {
        return $query->where('user_id', auth()->id())->whereNull('status_id');
    }
}
