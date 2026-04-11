@extends('layouts.main')

@section('title', 'Checkout | Potion Spot')

@section('content')
<main>
  <div class="container-lg my-4 my-lg-5">
    {{-- Page title --}}
    <div class="mb-4">
      <h1 class="ps-page-title mb-1">Checkout</h1>
      <p class="ps-checkout-page-subtitle">
        Complete your magical order and finalize shipping details.
      </p>
    </div>

    <div class="row g-4 g-lg-5">
      {{-- Checkout forms --}}
      <section class="col-12 col-lg-8" aria-label="Checkout forms">
        <form aria-label="Checkout details">
          {{-- Contact details --}}
          <section class="mb-5" aria-labelledby="checkout-contact-title">
            <div class="ps-checkout-section-heading">
              <svg
                class="ps-checkout-section-heading-icon"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
                width="20"
                height="20"
              >
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
              <h2 id="checkout-contact-title" class="ps-checkout-section-title">
                Contact Information
              </h2>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-12 col-sm-6">
                <label for="firstName" class="ps-checkout-label">First Name</label>
                <input type="text" class="ps-checkout-input" id="firstName" placeholder="" />
              </div>
              <div class="col-12 col-sm-6">
                <label for="lastName" class="ps-checkout-label">Last Name</label>
                <input type="text" class="ps-checkout-input" id="lastName" placeholder="" />
              </div>
            </div>

            <div class="row g-3">
              <div class="col-12 col-sm-6">
                <label for="email" class="ps-checkout-label">Email Address</label>
                <input type="email" class="ps-checkout-input" id="email" placeholder="" />
              </div>
              <div class="col-12 col-sm-6">
                <label for="phone" class="ps-checkout-label">Phone Number</label>
                <input type="tel" class="ps-checkout-input" id="phone" placeholder="" />
              </div>
            </div>
          </section>

          {{-- Shipping address --}}
          <section class="mb-5" aria-labelledby="checkout-shipping-title">
            <div class="ps-checkout-section-heading">
              <svg
                class="ps-checkout-section-heading-icon"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
                width="22"
                height="16"
              >
                <rect x="1" y="3" width="15" height="13" />
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                <circle cx="5.5" cy="18.5" r="2.5" />
                <circle cx="18.5" cy="18.5" r="2.5" />
              </svg>
              <h2 id="checkout-shipping-title" class="ps-checkout-section-title">
                Shipping Address
              </h2>
            </div>

            <div class="mb-3">
              <label for="street" class="ps-checkout-label">Street Address</label>
              <input type="text" class="ps-checkout-input" id="street" placeholder="" />
            </div>

            <div class="row g-3 mb-3">
              <div class="col-12 col-sm-6">
                <label for="apartment" class="ps-checkout-label">Apartment / Suite (Optional)</label>
                <input type="text" class="ps-checkout-input" id="apartment" placeholder="" />
              </div>
              <div class="col-12 col-sm-6">
                <label for="city" class="ps-checkout-label">City</label>
                <input type="text" class="ps-checkout-input" id="city" placeholder="" />
              </div>
            </div>

            <div class="row g-3">
              <div class="col-12 col-sm-6">
                <label for="postalCode" class="ps-checkout-label">Postal / ZIP Code</label>
                <input type="text" class="ps-checkout-input" id="postalCode" placeholder="" />
              </div>
              <div class="col-12 col-sm-6">
                <label for="country" class="ps-checkout-label">Country</label>
                <select class="ps-checkout-input ps-checkout-select" id="country">
                  <option>Slovakia</option>
                  <option>Czech Republic</option>
                  <option>Austria</option>
                  <option>Hungary</option>
                  <option>Poland</option>
                  <option>Germany</option>
                  <option>Other</option>
                </select>
              </div>
            </div>
          </section>

          {{-- Delivery method --}}
          <section class="ps-checkout-delivery-section" aria-labelledby="checkout-delivery-title">
            <div class="ps-checkout-section-heading">
              <svg
                class="ps-checkout-section-heading-icon"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
                width="22"
                height="16"
              >
                <rect x="1" y="3" width="15" height="13" />
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                <circle cx="5.5" cy="18.5" r="2.5" />
                <circle cx="18.5" cy="18.5" r="2.5" />
              </svg>
              <h2 id="checkout-delivery-title" class="ps-checkout-section-title">
                Delivery Method
              </h2>
            </div>

            <div>
              <label for="deliveryMethod" class="ps-checkout-label">Delivery Method</label>
              <select class="ps-checkout-input ps-checkout-select" id="deliveryMethod">
                <option>Courier delivery - 5 Gold</option>
              </select>
            </div>
          </section>
        </form>
      </section>

      {{-- Order summary --}}
      <aside class="col-12 col-lg-4" aria-label="Order summary">
        <div class="ps-checkout-summary-card">
          <h2 class="ps-summary-title mb-4">Summary</h2>

          <div class="ps-checkout-order-item">
            <img
              class="ps-checkout-order-item-img"
              src="{{ asset('images/potion-images/healing-potion.png') }}"
              alt="Healing Potion"
            />
            <div class="flex-grow-1">
              <p class="ps-checkout-order-item-name mb-0">Healing Potion</p>
              <p class="ps-checkout-order-item-qty mb-0">Qty: 1</p>
            </div>
            <span class="ps-checkout-order-item-price">25 Gold</span>
          </div>

          <div class="ps-checkout-order-item">
            <img
              class="ps-checkout-order-item-img"
              src="{{ asset('images/potion-images/speed-potion.png') }}"
              alt="Speed Potion"
            />
            <div class="flex-grow-1">
              <p class="ps-checkout-order-item-name mb-0">Speed Potion</p>
              <p class="ps-checkout-order-item-qty mb-0">Qty: 2</p>
            </div>
            <span class="ps-checkout-order-item-price">80 Gold</span>
          </div>

          <div aria-label="Price details">
            <div class="ps-summary-row">
              <span class="ps-summary-label">Subtotal</span>
              <span class="ps-summary-value mb-0">105 Gold</span>
            </div>
            <div class="ps-summary-row">
              <span class="ps-summary-label">Shipping</span>
              <span class="ps-summary-value mb-0">5 Gold</span>
            </div>
          </div>

          <hr class="ps-summary-divider" />

          <div class="ps-summary-total">
            <span>Total</span>
            <strong>110 Gold</strong>
          </div>

          <a href="{{ url('/payment') }}" class="ps-btn-payment">Payment</a>
        </div>
      </aside>
    </div>
  </div>
</main>
@endsection
