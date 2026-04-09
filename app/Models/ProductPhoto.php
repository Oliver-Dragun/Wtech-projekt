<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPhoto extends Model
{
    public $timestamps = false;

    protected $fillable = ['photo_id', 'number', 'img'];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'photo_id');
    }
}
