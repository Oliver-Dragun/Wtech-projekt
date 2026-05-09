<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// One image of a product, number = display order, 0 = main image.
class ProductPhoto extends Model
{
    public $timestamps = false;

    protected $fillable = ['product_id', 'number', 'img'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
