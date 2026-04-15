<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Uses factory support for model creation.
    use HasFactory, Notifiable;

    // Attributes that are mass assignable.
    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'email',
        'password',
        'is_admin',
    ];

    // Attributes hidden during serialization.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Return attributes that should be cast.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
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
