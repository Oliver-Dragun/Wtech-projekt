@extends('layouts.main')

@section('title', 'My Profile | Potion Spot')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">Hi, {{ $user->name }} {{ $user->surname }}</h2>

  <style>
    .ps-profile-fields .form-control {
      background-color: #fff !important;
      border: 1.5px solid #212529 !important;
      border-radius: 4px;
      box-shadow: none !important;
    }
    .ps-profile-fields .form-control:focus {
      background-color: #fff !important;
      border-color: #212529 !important;
      box-shadow: 0 0 0 0.2rem rgba(33, 37, 41, 0.2) !important;
    }
  </style>

  <h4 class="mb-3">Profile</h4>

  <div class="card border shadow mb-5">
    <div class="card-body">
  <form class="ps-profile-fields" method="POST" action="/profile">
      @csrf
      @method('PATCH')

      <div class="row g-3">
        <div class="col-12 col-md-6">
          <div class="mb-3">
            <label class="form-label">Full name *</label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
              name="full_name"
              value="{{ old('full_name', $user->name . ' ' . $user->surname) }}" />
            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
              name="email"
              value="{{ old('email', $user->email) }}" />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Address *</label>
            <input type="text" class="form-control @error('street_address') is-invalid @enderror"
              name="street_address"
              value="{{ old('street_address', $user->address?->street_address ?? '') }}" />
            @error('street_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="mb-3">
            <label class="form-label">Area code *</label>
            <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
              name="postal_code"
              value="{{ old('postal_code', $user->address?->postal_code ?? '') }}" />
            @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="form-label">City *</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror"
              name="city"
              value="{{ old('city', $user->address?->city ?? '') }}" />
            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Country</label>
            <input type="text" class="form-control @error('country') is-invalid @enderror"
              name="country"
              value="{{ old('country', $user->address?->country ?? '') }}" />
            @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Phone number *</label>
            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
              name="phone_number"
              value="{{ old('phone_number', $user->phone_number ?? '') }}" />
            @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
  </form>
    </div>
  </div>

  <h4 class="mb-3">Orders</h4>

  @forelse($orders as $order)
    <div class="card border shadow mb-3 rounded-0" style="border-radius: 0 !important">
      <div class="card-body">
        @foreach($order->items as $item)
          <div class="d-flex flex-column flex-lg-row align-items-start gap-3{{ $loop->first ? '' : ' mt-3 pt-3 border-top' }}">
            <img
              src="{{ asset($item->product->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
              alt="{{ $item->product->name }}"
              class="flex-shrink-0"
              style="height: 140px; width: 140px; object-fit: contain; background-color: white; border: 1px solid #e5e7eb;"
            />
            <div class="d-flex flex-row flex-grow-1 justify-content-between w-100">
              <div>
                <h5 class="mb-1">{{ $item->product->name }}</h5>
                <p class="mb-2 text-muted">Order #{{ $order->id }}</p>
                <p class="mb-1"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                <p class="mb-0"><strong>Price:</strong> {{ $item->product->price }} Gold</p>
              </div>
              <div class="text-end">
                @if($loop->first)
                  <p class="mb-1 text-muted">
                    {{ $order->date ? \Carbon\Carbon::parse($order->date)->format('Y/m/d') : '—' }}
                  </p>
                  <p class="mb-1">{{ $order->status->name ?? '—' }}</p>
                  <p class="mb-2 fw-bold">{{ $order->sum }} Gold</p>
                @endif
                @if(($order->status->name ?? '') === 'Delivered')
                  <a href="/product/{{ $item->product_id }}#reviews" class="btn btn-outline-primary">Review product</a>
                @elseif($loop->first)
                  <button class="btn btn-primary">Track Order</button>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @empty
    <p class="text-muted">You have no orders yet.</p>
  @endforelse
</div>
@endsection
