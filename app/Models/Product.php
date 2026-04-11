<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'category_id', 'effect', 'grade', 'price', 'is_bundle'];

    protected $casts = [
        'price'     => 'integer',
        'is_bundle' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class)->orderBy('number');
    }

    public function mainPhoto(): HasOne
    {
        return $this->hasOne(ProductPhoto::class)->where('number', 0);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
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
