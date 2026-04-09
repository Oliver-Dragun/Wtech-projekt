<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function productTypes(): HasMany
    {
        return $this->hasMany(ProductType::class, 'category_id');
    }
}
