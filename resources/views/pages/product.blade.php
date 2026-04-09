@extends('layouts.main')

@section('title', $product->type->name . ' — Potion Spot')

@section('content')
<main>
  <div class="container-lg my-4">
    {{-- Product path --}}
    <nav aria-label="Product path" class="mb-4">
      <ol class="ps-path-list">
        <li class="ps-path-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="ps-path-item">
          <a href="{{ url('/shop?category=' . $product->type->category_id) }}">{{ $product->type->category->name }}</a>
        </li>
        <li class="ps-path-item active" aria-current="page">
          {{ $product->type->name }}
        </li>
      </ol>
    </nav>

    {{-- Product --}}
    <section aria-label="Product details" class="mb-5">
      <div class="row g-4 g-lg-5">
        {{-- Image gallery --}}
        <div class="col-12 col-lg-5">
          @php
            $photos = $product->type->photos;
            $mainPhoto = $photos->firstWhere('number', 1) ?? $photos->first();
            $thumbSlots = $photos->take(4)->values();
            while ($thumbSlots->count() < 4) {
                $thumbSlots->push($mainPhoto);
            }
          @endphp

          <div class="ps-gallery-main mb-3">
            <img
              src="{{ asset($mainPhoto->img) }}"
              alt="{{ $product->type->name }} — main img"
            />
          </div>

          <div class="row g-2">
            @foreach($thumbSlots as $thumb)
              <div class="col-3">
                <img
                  src="{{ asset($thumb->img) }}"
                  alt="{{ $product->type->name }} — img {{ $loop->iteration }}"
                  class="ps-gallery-thumb"
                />
              </div>
            @endforeach
          </div>
        </div>

        {{-- Description --}}
        <div class="col-12 col-lg-7">
          <h1 class="ps-product-title mb-2">{{ $product->type->name }}</h1>
          <p class="ps-font-lg text-ps-black-60 mb-4">
            <strong>{{ $product->price }} Gold</strong>
          </p>

          <h2 class="ps-font-xl mb-3">Description</h2>
          <p class="ps-font-lg text-ps-grey mb-4">
            {{ $product->type->description }}
          </p>

          {{-- Quantity selector and add to cart --}}
          <form
            action="{{ route('cart.add') }}"
            method="post"
            class="d-flex align-items-center gap-3 mt-4"
          >
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <fieldset class="ps-qty-stepper">
              <legend class="visually-hidden">Quantity</legend>
              <button type="button" aria-label="Decrease quantity"
                onclick="let i=this.nextElementSibling;i.value=Math.max(1,+i.value-1)">−</button>
              <input
                type="number"
                name="quantity"
                value="1"
                min="1"
                max="99"
                aria-label="Quantity"
              />
              <button type="button" aria-label="Increase quantity"
                onclick="let i=this.previousElementSibling;i.value=Math.min(99,+i.value+1)">+</button>
            </fieldset>
            <button
              type="submit"
              class="ps-btn-add-to-cart flex-grow-1"
            >
              Add to Cart
            </button>
          </form>
        </div>
      </div>
    </section>

    {{-- Product details tabs --}}
    <section aria-label="Product information" class="mb-5">
      <ul class="nav ps-tabs mb-0" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="details-tab"
            type="button"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#details"
            aria-controls="details"
            aria-selected="true"
          >
            Product Details
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="reviews-tab"
            type="button"
            role="tab"
            data-bs-toggle="tab"
            data-bs-target="#reviews"
            aria-controls="reviews"
            aria-selected="false"
          >
            Reviews ({{ $product->type->reviews->count() }})
          </button>
        </li>
      </ul>

      <div class="tab-content ps-tab-content">
        <div
          class="tab-pane fade show active"
          id="details"
          role="tabpanel"
          aria-labelledby="details-tab"
        >
          <h3 class="ps-font-md fw-bold mb-3">Product Details</h3>
          @if($product->type->effects->isNotEmpty())
            <ul class="ps-font-base text-ps-black-60 mb-0">
              @foreach($product->type->effects as $pe)
                <li>{{ $pe->effect->name }} — {{ $pe->strength }}</li>
              @endforeach
            </ul>
          @else
            <p class="ps-font-base text-ps-black-60">No details available.</p>
          @endif
        </div>
        <div
          class="tab-pane fade"
          id="reviews"
          role="tabpanel"
          aria-labelledby="reviews-tab"
        >
          <h3 class="ps-font-md fw-bold mb-3">Customer Reviews</h3>
          <p class="ps-font-base text-ps-black-60">
            No reviews yet. Be the first to share your experience!
          </p>
        </div>
      </div>
    </section>
  </div>

  <div class="container my-5">
    <h2 class="mb-4">Recommended for you</h2>
    <div class="position-relative">
      <div class="row g-4 justify-content-center">
        @foreach($recommended as $rec)
          <div class="col-6 col-md-3" style="min-width: 280px">
            <div class="card border-0">
              <div class="card-body">
                <img
                  src="{{ asset($rec->type->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
                  alt="{{ $rec->type->name }}"
                  class="bg-light mb-3 rounded"
                  style="height: 200px; width: 100%; object-fit: contain"
                />
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="card-title mb-1">{{ $rec->type->name }}</h5>
                    <p class="card-text text-muted mb-0">{{ $rec->price }} Gold</p>
                  </div>
                  <a href="{{ url('/product/' . $rec->id) }}" class="btn btn-primary">Learn more</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <button
        class="btn btn-light position-absolute top-50 start-0 translate-middle-y border-0 shadow-sm"
        style="left: -20px; z-index: 10"
      >
        <img src="{{ asset('images/arrow.png') }}" alt="previous" style="width: 20px" />
      </button>
      <button
        class="btn btn-light position-absolute top-50 end-0 border-0 shadow-sm"
        style="right: -20px; transform: translateY(-50%); z-index: 10"
      >
        <img
          src="{{ asset('images/arrow.png') }}"
          alt="next"
          style="width: 20px; transform: rotate(180deg)"
        />
      </button>
    </div>
  </div>
</main>
@endsection
