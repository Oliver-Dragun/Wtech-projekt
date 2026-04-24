@extends('layouts.main')

@section('title', 'Payment | Potion Spot')

@section('page_header')@endsection
@section('page_footer')@endsection

@section('content')
<div class="login-container">
  <div class="login-card border shadow">
    <div class="text-center mb-4">
      <img class="logo py-3" src="{{ asset('images/logo_resized.png') }}" alt="Potion Spot" />
      <h2 class="mb-1">Card Payment</h2>
      <p class="ps-font-sm text-ps-grey mb-0">
        Enter your card details to complete the purchase
      </p>
      <p class="fw-bold mt-2 mb-0">Total: {{ $order->sum }} Gold</p>
    </div>

    <form method="POST" action="/payment">
      @csrf

      <div class="mb-3">
        <label for="cardNumber" class="form-label">Card Number</label>
        <input
          type="text"
          class="ps-input"
          id="cardNumber"
          name="card_number"
          placeholder="0000 0000 0000 0000"
          maxlength="19"
        />
      </div>

      <div class="row mb-3">
        <div class="col-6">
          <label for="expiry" class="form-label">Expiry Date</label>
          <input
            type="text"
            class="ps-input"
            id="expiry"
            name="expiry"
            placeholder="MM / YY"
            maxlength="7"
          />
        </div>
        <div class="col-6">
          <label for="cvv" class="form-label">CVV</label>
          <input
            type="text"
            class="ps-input"
            id="cvv"
            name="cvv"
            placeholder="•••"
            maxlength="4"
          />
        </div>
      </div>

      <div class="mb-3">
        <label for="cardName" class="form-label">Full Name</label>
        <input
          type="text"
          class="ps-input"
          id="cardName"
          name="card_name"
          placeholder="Name as on card"
        />
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3">
        Pay Now
      </button>
    </form>

    <div class="text-center">
      <a href="#" class="ps-payment-secure-link">Your payment is secured with encryption</a>
    </div>
  </div>
</div>
@endsection
