<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Shipping option shown on the checkout page
class ShippingMethod extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'price'];
}
