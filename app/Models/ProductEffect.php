<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductEffect extends Model
{
    public $timestamps = false;

    protected $fillable = ['effect_id', 'product_type_id', 'strength'];

    public function effect(): BelongsTo
    {
        return $this->belongsTo(Effect::class);
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
