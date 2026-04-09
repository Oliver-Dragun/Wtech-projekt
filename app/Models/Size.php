<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    public $timestamps = false;

    protected $fillable = ['size'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
