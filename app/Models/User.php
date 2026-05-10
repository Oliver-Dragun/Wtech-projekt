<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Registered user, extends Authenticatable from Laravel for authentication, includes is_admin field
class User extends Authenticatable
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'email',
        'password',
        'is_admin',
        'address_id',
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
