@extends('layouts.main')

@section('title', 'Potion Spot')

@section('content')
<div class="container my-4">
  <div class="row g-3">
    <div class="col-12 col-lg-8">
      <div class="ps-hero-card">
        <div class="ps-hero-card-body">
          <img
            src="{{ asset('images/starterkit.png') }}"
            alt="Potion Brewing Starter Kit"
            class="ps-hero-card-img"
          />
          <div class="ps-hero-card-label">Exclusive offer</div>
          <h2 class="ps-hero-card-title">Potion Brewing Starter Kit</h2>
          <p class="ps-hero-card-text">
            Everything you need to start your alchemical journey
          </p>
          <div class="ps-hero-actions">
            <span class="ps-discount-badge">-20%</span>
            <button class="btn btn-primary btn-lg align-self-start">
              Learn more
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-4 d-flex flex-column gap-3">
      <div class="ps-side-offer-card">
        <div class="ps-side-offer-card-body">
          <div class="ps-side-offer-label">30% Stronger</div>
          <h4 class="ps-side-offer-title">Restoration Potion</h4>
          <p class="ps-side-offer-text">Restore your vitality instantly</p>
          <button class="btn btn-primary mt-2 align-self-start ps-btn-buy">
            Buy now!
          </button>
        </div>
      </div>

      <div class="ps-side-offer-card">
        <div class="ps-side-offer-card-body">
          <div class="ps-side-offer-label">New recipe</div>
          <h4 class="ps-side-offer-title">Healing Potion</h4>
          <p class="ps-side-offer-text">Advanced healing formula</p>
          <button class="btn btn-primary mt-2 align-self-start ps-btn-buy">
            Buy now!
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container my-5">
  <h2 class="ps-section-title">New Products</h2>
  <hr class="ps-section-divider" />
  <div class="ps-products-container">
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/healing-potion.png') }}"
          alt="Healing Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Healing Potion</h5>
            <p class="ps-product-price">25 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/speed-potion.png') }}"
          alt="Speed Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Speed Potion</h5>
            <p class="ps-product-price">30 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/fireresistance-potion.png') }}"
          alt="Fire Resistance Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Fire Resistance Potion</h5>
            <p class="ps-product-price">40 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/restoration-potion.png') }}"
          alt="Restoration Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Restoration Potion</h5>
            <p class="ps-product-price">35 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/mana-potion.png') }}"
          alt="Mana Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Mana Potion</h5>
            <p class="ps-product-price">20 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/invisibility-potion.png') }}"
          alt="Invisibility Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Invisibility Potion</h5>
            <p class="ps-product-price">50 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/strength-potion.png') }}"
          alt="Strength Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Strength Potion</h5>
            <p class="ps-product-price">45 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/fortitude-potion.png') }}"
          alt="Fortitude Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Fortitude Potion</h5>
            <p class="ps-product-price">55 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container my-5">
  <h2 class="ps-section-title">Recommended for you</h2>
  <div class="ps-products-container">
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/speed-potion.png') }}"
          alt="Speed Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Speed Potion</h5>
            <p class="ps-product-price">30 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/healing-potion.png') }}"
          alt="Healing Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Healing Potion</h5>
            <p class="ps-product-price">25 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/fireresistance-potion.png') }}"
          alt="Fire Resistance Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Fire Resistance Potion</h5>
            <p class="ps-product-price">40 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
    <div class="ps-product-card">
      <div class="ps-product-card-body">
        <img
          src="{{ asset('images/potion-images/mana-potion.png') }}"
          alt="Mana Potion"
          class="ps-product-img"
        />
        <div class="ps-product-info">
          <div>
            <h5 class="ps-product-title">Mana Potion</h5>
            <p class="ps-product-price">20 Gold</p>
          </div>
          <a href="{{ url('/product') }}" class="btn btn-primary">Buy</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
