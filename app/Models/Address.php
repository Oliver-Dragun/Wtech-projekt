<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

// Stores a physical address, used by both users and orders
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

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
}
