@extends('layouts.main')

@section('title', 'Potion Spot')

@section('content')
<div class="container my-4">
  <div class="row g-3">
    <div class="col-12 col-lg-8">
      <div class="ps-hero-card">
        <div class="ps-hero-card-body">
          <div>
            <div class="ps-hero-card-label">Exclusive offer</div>
            <h2 class="ps-hero-card-title">{{ $featuredBundle->name }}</h2>
            <p class="ps-hero-card-text">
              {{ $featuredBundle->description }}
            </p>
          </div>
          <div class="ps-hero-card-bottom">
            <div class="d-flex flex-column align-items-start gap-2">
              <span class="ps-discount-badge" style="font-size: 1rem">Bundle</span>
              <a href="{{ url('/product/' . $featuredBundle->id) }}" class="btn btn-primary btn-lg">
                Learn more
              </a>
            </div>
            <img
              src="{{ asset($featuredBundle->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
              alt="{{ $featuredBundle->name }}"
              class="ps-hero-card-img"
            />
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-4 d-flex flex-column gap-3" style="min-height: 100%">
      @foreach($sideOffers as $offer)
        <div class="ps-side-offer-card">
          <div class="ps-side-offer-card-body">
            <img
              src="{{ asset($offer->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
              alt="{{ $offer->name }}"
              style="width: 120px; height: 120px; object-fit: contain; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); opacity: 0.8"
            />
            <div class="ps-side-offer-label">{{ $offer->grade }}</div>
            <h4 class="ps-side-offer-title">{{ $offer->name }}</h4>
            <p class="ps-side-offer-text">{{ $offer->effect }} &middot; {{ $offer->price }} Gold</p>
            <a href="{{ url('/product/' . $offer->id) }}" class="btn btn-primary mt-2 align-self-start ps-btn-buy">
              Buy now!
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<div class="container my-5">
  <h2 class="ps-section-title">New Products</h2>
  <hr class="ps-section-divider" />
  <div class="ps-products-container">
    @foreach($newProducts as $product)
      <div class="ps-product-card">
        <div class="ps-product-card-body">
          <img
            src="{{ asset($product->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
            alt="{{ $product->name }}"
            class="ps-product-img"
          />
          <div class="ps-product-info">
            <div>
              <h5 class="ps-product-title">{{ $product->name }}</h5>
              <p class="ps-product-price">{{ $product->price }} Gold</p>
            </div>
            <a href="{{ url('/product/' . $product->id) }}" class="btn btn-primary">Buy</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<div class="container my-5">
  <h2 class="ps-section-title">Recommended for you</h2>
  <div class="ps-products-container">
    @foreach($recommended as $product)
      <div class="ps-product-card">
        <div class="ps-product-card-body">
          <img
            src="{{ asset($product->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
            alt="{{ $product->name }}"
            class="ps-product-img"
          />
          <div class="ps-product-info">
            <div>
              <h5 class="ps-product-title">{{ $product->name }}</h5>
              <p class="ps-product-price">{{ $product->price }} Gold</p>
            </div>
            <a href="{{ url('/product/' . $product->id) }}" class="btn btn-primary">Buy</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
