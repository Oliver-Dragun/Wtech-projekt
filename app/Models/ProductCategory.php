<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Product categories: Potions, Scrolls, Orbs, Artifacts, Bundles
class ProductCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
