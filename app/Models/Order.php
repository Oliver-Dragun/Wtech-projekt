<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Represents both an active cart (status_id = null) and a placed order
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

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActiveCart($query)
    {
        return $query->where('user_id', auth()->id())->whereNull('status_id');
    }
}
