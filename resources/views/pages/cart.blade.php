@extends('layouts.main')

@section('title', 'Shopping Cart — Potion Spot')

@section('html_class', 'ps-cart-page')
@section('body_class', 'ps-cart-page-body')

@section('content')
<main class="ps-cart-page-main">
  <div class="container-lg my-4 my-lg-5">
    <h1 class="ps-page-title mb-4">Shopping Cart</h1>

    <div class="row g-4 g-lg-5">
      {{-- Cart items --}}
      <section class="col-12 col-lg-8" aria-label="Cart items">
        @forelse($items as $item)
          <article class="ps-cart-item">
            <img
              class="ps-cart-item-img"
              src="{{ asset($item->product->type->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
              alt="{{ $item->product->type->name }}"
            />
            <div class="ps-cart-item-body">
              <div class="ps-cart-item-head">
                <div>
                  <p class="ps-cart-item-name mb-0">{{ $item->product->type->name }}</p>
                  <p class="ps-cart-item-variant mb-0">{{ $item->product->size->size }}</p>
                </div>
                <div class="text-end">
                  <span class="ps-cart-item-price d-block">{{ $item->product->price * $item->quantity }} Gold</span>
                  <form method="POST" action="{{ route('cart.update', $item->product_id) }}">
                    @csrf
                    <button type="submit" name="action" value="remove" class="ps-btn-remove mt-1">
                      Remove
                    </button>
                  </form>
                </div>
              </div>
              <div class="ps-cart-item-actions">
                <form
                  action="{{ route('cart.update', $item->product_id) }}"
                  method="post"
                >
                  @csrf
                  <fieldset
                    class="ps-cart-stepper"
                    aria-label="Quantity for {{ $item->product->type->name }}"
                  >
                    <legend class="visually-hidden">Quantity</legend>
                    <button
                      type="submit"
                      name="action"
                      value="decrease"
                      aria-label="Decrease"
                    >−</button>
                    <input
                      type="number"
                      name="quantity"
                      value="{{ $item->quantity }}"
                      min="1"
                      max="99"
                      aria-label="Quantity"
                    />
                    <button
                      type="submit"
                      name="action"
                      value="increase"
                      aria-label="Increase"
                    >+</button>
                  </fieldset>
                </form>
              </div>
            </div>
          </article>
        @empty
          <p class="text-muted py-4">Your cart is empty.</p>
        @endforelse
      </section>

      {{-- Summary --}}
      <aside class="col-12 col-lg-4" aria-label="Order summary">
        <div class="ps-summary-card">
          <h2 class="ps-summary-title mb-4">Summary</h2>

          <dl>
            <div class="ps-summary-row">
              <dt class="ps-summary-label">Subtotal</dt>
              <dd class="ps-summary-value mb-0">{{ $subtotal }} Gold</dd>
            </div>
            <div class="ps-summary-row">
              <dt class="ps-summary-label">Shipping</dt>
              <dd class="ps-summary-value mb-0">—</dd>
            </div>
          </dl>

          <hr class="ps-summary-divider" />

          <div class="ps-summary-total">
            <span>Total</span>
            <strong>{{ $subtotal }} Gold</strong>
          </div>

          <a href="{{ url('/checkout') }}" class="ps-btn-checkout">Checkout</a>
          <a href="{{ url('/') }}" class="ps-btn-continue">Continue Shopping</a>
        </div>
      </aside>
    </div>
  </div>
</main>
@endsection
