<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

// A shop product (potion, scroll, orb, artifact, or bundle)
class Product extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'category_id', 'effect', 'grade', 'price', 'created_at'];

    protected $casts = [
        'price' => 'integer',
    ];

    // Category (Potions / Scrolls / Orbs / Artifacts / Bundles)
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // All photos for this product, ordered by their number
    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class)->orderBy('number');
    }

    // Just the main image (number = 0). Used in lists where we only show the main photo.
    public function mainPhoto(): HasOne
    {
        return $this->hasOne(ProductPhoto::class)->where('number', 0);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Cart/order items referencing this product, used for sorting by number of orders.
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Used for search by name in search bar in the header
    public function scopeSearch($query, string $term)
    {
        return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($term) . '%']);
    }
}
