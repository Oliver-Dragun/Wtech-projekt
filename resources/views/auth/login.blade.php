@extends('layouts.main')

@section('title', 'Login')

@section('page_header')@endsection
@section('page_footer')@endsection

@section('content')
<div class="login-container">
  <div class="login-card border shadow">
    <div class="text-center mb-4">
      <img class="logo py-3" src="{{ asset('images/logo_resized.png') }}" />
      <h2 class="mb-4">Login</h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          class="ps-input"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Enter your email"
          required
          autofocus
          autocomplete="username"
        />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          class="ps-input"
          id="password"
          name="password"
          placeholder="Enter your password"
          required
          autocomplete="current-password"
        />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <div class="text-center mb-3">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" style="opacity: 0.6; text-decoration: underline">
            Forgot password?
          </a>
        @endif
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3">
        Login
      </button>

      <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 mb-3">
        Create Account
      </a>
    </form>

    <div class="text-center">
      <a href="#" style="opacity: 0.6; text-decoration: underline">Continue as guest</a>
    </div>
  </div>
</div>
@endsection
