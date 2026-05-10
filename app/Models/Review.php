<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Review of a product
class Review extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'product_id', 'body', 'rating', 'date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
