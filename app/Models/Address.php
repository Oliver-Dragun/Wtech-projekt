<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

// Physical address. Used for both the user's saved address and order shipping address.
class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'street_address',
        'apartment',
        'city',
        'postal_code',
        'country',
    ];

    // The user this address belongs to (if saved)
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    // Orders that shipped to this address
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
}
