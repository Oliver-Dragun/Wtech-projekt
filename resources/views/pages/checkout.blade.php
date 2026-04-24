@extends('layouts.main')

@section('title', 'Checkout | Potion Spot')

@section('content')
<main
  x-data="{
    shippingPrice: {{ $shippingMethods->first()->price ?? 0 }},
    subtotal: {{ $subtotal }},
    get total() { return this.subtotal + this.shippingPrice; }
  }"
>
  <div class="container-lg my-4 my-lg-5">
    <div class="mb-4">
      <h1 class="ps-page-title mb-1">Checkout</h1>
      <p class="ps-checkout-page-subtitle">
        Complete your magical order and finalize shipping details.
      </p>
    </div>

    <div class="row g-4 g-lg-5">
      <section class="col-12 col-lg-8" aria-label="Checkout forms">
        <form id="checkout-form" method="POST" action="/checkout" aria-label="Checkout details">
          @csrf

          <section class="mb-5" aria-labelledby="checkout-contact-title">
            <div class="ps-checkout-section-heading">
              <svg class="ps-checkout-section-heading-icon" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" width="20" height="20">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
              <h2 id="checkout-contact-title" class="ps-checkout-section-title">Contact Information</h2>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-12 col-sm-6">
                <label for="name" class="ps-checkout-label">First Name</label>
                <input type="text" class="ps-checkout-input @error('name') is-invalid @enderror"
                  id="name" name="name" value="{{ old('name', auth()->user()->name) }}" />
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-sm-6">
                <label for="surname" class="ps-checkout-label">Last Name</label>
                <input type="text" class="ps-checkout-input @error('surname') is-invalid @enderror"
                  id="surname" name="surname" value="{{ old('surname', auth()->user()->surname) }}" />
                @error('surname')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row g-3">
              <div class="col-12 col-sm-6">
                <label for="email" class="ps-checkout-label">Email Address</label>
                <input type="email" class="ps-checkout-input @error('email') is-invalid @enderror"
                  id="email" name="email" value="{{ old('email', auth()->user()->email) }}" />
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-sm-6">
                <label for="phone_number" class="ps-checkout-label">Phone Number</label>
                <input type="tel" class="ps-checkout-input @error('phone_number') is-invalid @enderror"
                  id="phone_number" name="phone_number"
                  value="{{ old('phone_number', auth()->user()->phone_number) }}" />
                @error('phone_number')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </section>

          <section class="mb-5" aria-labelledby="checkout-shipping-title">
            <div class="ps-checkout-section-heading">
              <svg class="ps-checkout-section-heading-icon" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" width="22" height="16">
                <rect x="1" y="3" width="15" height="13" />
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                <circle cx="5.5" cy="18.5" r="2.5" />
                <circle cx="18.5" cy="18.5" r="2.5" />
              </svg>
              <h2 id="checkout-shipping-title" class="ps-checkout-section-title">Shipping Address</h2>
            </div>

            <div class="mb-3">
              <label for="street_address" class="ps-checkout-label">Street Address</label>
              <input type="text" class="ps-checkout-input @error('street_address') is-invalid @enderror"
                id="street_address" name="street_address" value="{{ old('street_address', auth()->user()->address?->street_address ?? '') }}" />
              @error('street_address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="row g-3 mb-3">
              <div class="col-12 col-sm-6">
                <label for="apartment" class="ps-checkout-label">Apartment / Suite (Optional)</label>
                <input type="text" class="ps-checkout-input @error('apartment') is-invalid @enderror"
                  id="apartment" name="apartment" value="{{ old('apartment', auth()->user()->address?->apartment ?? '') }}" />
                @error('apartment')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-sm-6">
                <label for="city" class="ps-checkout-label">City</label>
                <input type="text" class="ps-checkout-input @error('city') is-invalid @enderror"
                  id="city" name="city" value="{{ old('city', auth()->user()->address?->city ?? '') }}" />
                @error('city')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row g-3">
              <div class="col-12 col-sm-6">
                <label for="postal_code" class="ps-checkout-label">Postal / ZIP Code</label>
                <input type="text" class="ps-checkout-input @error('postal_code') is-invalid @enderror"
                  id="postal_code" name="postal_code" value="{{ old('postal_code', auth()->user()->address?->postal_code ?? '') }}" />
                @error('postal_code')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-sm-6">
                <label for="country" class="ps-checkout-label">Country</label>
                <input type="text" class="ps-checkout-input @error('country') is-invalid @enderror"
                  id="country" name="country" value="{{ old('country', auth()->user()->address?->country ?? '') }}" />
                @error('country')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </section>

          <section class="ps-checkout-delivery-section" aria-labelledby="checkout-delivery-title">
            <div class="ps-checkout-section-heading">
              <svg class="ps-checkout-section-heading-icon" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" width="22" height="16">
                <rect x="1" y="3" width="15" height="13" />
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                <circle cx="5.5" cy="18.5" r="2.5" />
                <circle cx="18.5" cy="18.5" r="2.5" />
              </svg>
              <h2 id="checkout-delivery-title" class="ps-checkout-section-title">Delivery Method</h2>
            </div>

            <div>
              <label for="shipping_method_id" class="ps-checkout-label">Delivery Method</label>
              <select
                class="ps-checkout-input ps-checkout-select @error('shipping_method_id') is-invalid @enderror"
                id="shipping_method_id"
                name="shipping_method_id"
                x-on:change="shippingPrice = parseInt($event.target.selectedOptions[0].dataset.price)"
              >
                @foreach($shippingMethods as $method)
                  <option
                    value="{{ $method->id }}"
                    data-price="{{ $method->price }}"
                    {{ old('shipping_method_id') == $method->id ? 'selected' : '' }}
                  >
                    {{ $method->name }} — {{ $method->price }} Gold
                  </option>
                @endforeach
              </select>
              @error('shipping_method_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </section>

          <div class="mt-4 d-lg-none">
            <button type="submit" class="ps-btn-payment w-100">Proceed to Payment</button>
          </div>
        </form>
      </section>

      <aside class="col-12 col-lg-4" aria-label="Order summary">
        <div class="ps-checkout-summary-card">
          <h2 class="ps-summary-title mb-4">Summary</h2>

          @foreach($cart->items as $item)
            <div class="ps-checkout-order-item">
              <img
                class="ps-checkout-order-item-img"
                src="{{ asset($item->product->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
                alt="{{ $item->product->name }}"
              />
              <div class="flex-grow-1">
                <p class="ps-checkout-order-item-name mb-0">{{ $item->product->name }}</p>
                <p class="ps-checkout-order-item-qty mb-0">Qty: {{ $item->quantity }}</p>
              </div>
              <span class="ps-checkout-order-item-price">
                {{ $item->product->price * $item->quantity }} Gold
              </span>
            </div>
          @endforeach

          <div aria-label="Price details">
            <div class="ps-summary-row">
              <span class="ps-summary-label">Subtotal</span>
              <span class="ps-summary-value mb-0">{{ $subtotal }} Gold</span>
            </div>
            <div class="ps-summary-row">
              <span class="ps-summary-label">Shipping</span>
              <span class="ps-summary-value mb-0" x-text="shippingPrice + ' Gold'">
                {{ $shippingMethods->first()->price ?? 0 }} Gold
              </span>
            </div>
          </div>

          <hr class="ps-summary-divider" />

          <div class="ps-summary-total">
            <span>Total</span>
            <strong x-text="total + ' Gold'">
              {{ $subtotal + ($shippingMethods->first()->price ?? 0) }} Gold
            </strong>
          </div>

          <button type="submit" form="checkout-form" class="ps-btn-payment d-none d-lg-block w-100">
            Proceed to Payment
          </button>
        </div>
      </aside>
    </div>
  </div>
</main>
@endsection
