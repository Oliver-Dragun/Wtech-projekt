<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Order status (Pending / Processing / Shipped / Delivered / Cancelled)
class OrderStatus extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'status_id');
    }
}
