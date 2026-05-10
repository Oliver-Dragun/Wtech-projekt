<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Order status (Pending / Processing / Shipped / Delivered / Cancelled)
class OrderStatus extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
