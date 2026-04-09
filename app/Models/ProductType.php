<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductType extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class, 'photo_id')->orderBy('number');
    }

    public function mainPhoto(): HasOne
    {
        return $this->hasOne(ProductPhoto::class, 'photo_id')->where('number', 1);
    }

    public function effects(): HasMany
    {
        return $this->hasMany(ProductEffect::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
