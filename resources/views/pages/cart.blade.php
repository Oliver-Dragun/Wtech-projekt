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
        {{-- Item 1 --}}
        <article class="ps-cart-item">
          <img
            class="ps-cart-item-img"
            src="{{ asset('images/potion-images/healing-potion.png') }}"
            alt="Healing Potion"
          />
          <div class="ps-cart-item-body">
            <div class="ps-cart-item-head">
              <div>
                <p class="ps-cart-item-name mb-0">Healing Potion</p>
                <p class="ps-cart-item-variant mb-0">Speed · Basic</p>
              </div>
              <span class="ps-cart-item-price">25 Gold</span>
            </div>
            <div class="ps-cart-item-actions">
              <form
                action="#"
                method="post"
                class="d-flex align-items-center gap-3"
              >
                <fieldset
                  class="ps-cart-stepper"
                  aria-label="Quantity for Healing Potion"
                >
                  <legend class="visually-hidden">Quantity</legend>
                  <button
                    type="submit"
                    name="action"
                    value="decrease_1"
                    aria-label="Decrease"
                  >−</button>
                  <input
                    type="number"
                    name="quantity_1"
                    value="1"
                    min="1"
                    max="99"
                    aria-label="Quantity"
                  />
                  <button
                    type="submit"
                    name="action"
                    value="increase_1"
                    aria-label="Increase"
                  >+</button>
                </fieldset>
                <button
                  type="submit"
                  name="action"
                  value="remove_1"
                  class="ps-btn-remove"
                >
                  Remove
                </button>
              </form>
            </div>
          </div>
        </article>

        {{-- Item 2 --}}
        <article class="ps-cart-item">
          <img
            class="ps-cart-item-img"
            src="{{ asset('images/potion-images/speed-potion.png') }}"
            alt="Speed Potion"
          />
          <div class="ps-cart-item-body">
            <div class="ps-cart-item-head">
              <div>
                <p class="ps-cart-item-name mb-0">Speed Potion</p>
                <p class="ps-cart-item-variant mb-0">Speed · Greater</p>
              </div>
              <span class="ps-cart-item-price">40 Gold</span>
            </div>
            <div class="ps-cart-item-actions">
              <form
                action="#"
                method="post"
                class="d-flex align-items-center gap-3"
              >
                <fieldset
                  class="ps-cart-stepper"
                  aria-label="Quantity for Speed Potion"
                >
                  <legend class="visually-hidden">Quantity</legend>
                  <button
                    type="submit"
                    name="action"
                    value="decrease_2"
                    aria-label="Decrease"
                  >−</button>
                  <input
                    type="number"
                    name="quantity_2"
                    value="2"
                    min="1"
                    max="99"
                    aria-label="Quantity"
                  />
                  <button
                    type="submit"
                    name="action"
                    value="increase_2"
                    aria-label="Increase"
                  >+</button>
                </fieldset>
                <button
                  type="submit"
                  name="action"
                  value="remove_2"
                  class="ps-btn-remove"
                >
                  Remove
                </button>
              </form>
            </div>
          </div>
        </article>
      </section>

      {{-- Summary --}}
      <aside class="col-12 col-lg-4" aria-label="Order summary">
        <div class="ps-summary-card">
          <h2 class="ps-summary-title mb-4">Summary</h2>

          <dl>
            <div class="ps-summary-row">
              <dt class="ps-summary-label">Subtotal</dt>
              <dd class="ps-summary-value mb-0">105 Gold</dd>
            </div>
            <div class="ps-summary-row">
              <dt class="ps-summary-label">Shipping</dt>
              <dd class="ps-summary-value mb-0">5 Gold</dd>
            </div>
          </dl>

          <hr class="ps-summary-divider" />

          <div class="ps-summary-total">
            <span>Total</span>
            <strong>110 Gold</strong>
          </div>

          <a href="{{ route('login') }}" class="ps-btn-checkout">Checkout</a>
          <a href="{{ url('/') }}" class="ps-btn-continue">Continue Shopping</a>
        </div>
      </aside>
    </div>
  </div>
</main>
@endsection
