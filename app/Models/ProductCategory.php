<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Product categories: Potions, Scrolls, Orbs, Artifacts, Bundles
class ProductCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
