<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
