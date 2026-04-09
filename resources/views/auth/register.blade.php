@extends('layouts.main')

@section('title', 'Register')

@section('page_header')@endsection
@section('page_footer')@endsection

@section('content')
<div class="login-container">
  <div class="login-card border shadow">
    <div class="text-center mb-3">
      <img class="logo py-2" src="{{ asset('images/logo_resized.png') }}" />
      <h2 class="mb-3">Register</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="row g-2 mb-2">
        <div class="col-6">
          <label for="name" class="form-label">First Name</label>
          <input
            type="text"
            class="ps-input"
            id="name"
            name="name"
            value="{{ old('name') }}"
            placeholder="First name"
            required
            autofocus
            autocomplete="name"
          />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="col-6">
          <label for="last_name" class="form-label">Last Name</label>
          <input
            type="text"
            class="ps-input"
            id="last_name"
            placeholder="Last name"
          />
        </div>
      </div>

      <div class="mb-2">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          class="ps-input"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Enter your email"
          required
          autocomplete="username"
        />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="mb-2">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          class="ps-input"
          id="password"
          name="password"
          placeholder="Enter your password"
          required
          autocomplete="new-password"
        />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input
          type="password"
          class="ps-input"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Confirm your password"
          required
          autocomplete="new-password"
        />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3 py-2">
        Register
      </button>
    </form>

    <div class="text-center">
      <a href="{{ route('login') }}" style="opacity: 0.6; text-decoration: underline">
        Already have an account? Login
      </a>
    </div>
  </div>
</div>
@endsection
