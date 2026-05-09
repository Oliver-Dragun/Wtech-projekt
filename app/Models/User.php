<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Registered user, extends Authenticatable from Laravel for authentication, includes is_admin field
class User extends Authenticatable
{
    use Notifiable;

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

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
