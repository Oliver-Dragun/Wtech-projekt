<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = ['product_type_id', 'size_id', 'price', 'is_bundle'];

    protected $casts = [
        'price'     => 'integer',
        'is_bundle' => 'boolean',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function bundleComponents(): HasMany
    {
        return $this->hasMany(BundleComponent::class, 'bundle_product_id');
    }
}
