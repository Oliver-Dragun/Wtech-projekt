<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

// Handles login validation and rate limiting
class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // Text field validation
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    // Authemticates the user and handles rate limiting
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Attempt login
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // Wrong info -> increment rate limiter
            RateLimiter::hit($this->throttleKey());

            // Send user back to login with error message
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Login sucessfull -> clear rate limiter
        RateLimiter::clear($this->throttleKey());
    }

    // If too many wrong attempts -> lockout user from further attemps for some time
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    // Combines IP and email to form unique key for rate limiting sessions, 
    // does not stop the same user from logging in on devices thanks to IP + email combination
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
