@extends('layouts.main')

@section('title', 'Healing Potion — Potion Spot')

@section('content')
<main>
  <div class="container-lg my-4">
    {{-- Product path --}}
    <nav aria-label="Product path" class="mb-4">
      <ol class="ps-path-list">
        <li class="ps-path-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="ps-path-item">
          <a href="#">Potions</a>
        </li>
        <li class="ps-path-item active" aria-current="page">
          Healing Potion
        </li>
      </ol>
    </nav>

    {{-- Product --}}
    <section aria-label="Product details" class="mb-5">
      <div class="row g-4 g-lg-5">
        {{-- Image gallery --}}
        <div class="col-12 col-lg-5">
          <div class="ps-gallery-main mb-3">
            <img
              src="{{ asset('images/product-images/healing-potion/healing-potion-product-1.png') }}"
              alt="Healing Potion — main img"
            />
          </div>

          <div class="row g-2">
            <div class="col-3">
              <img
                src="{{ asset('images/product-images/healing-potion/healing-potion-product-1.png') }}"
                alt="Healing Potion — img 1"
                class="ps-gallery-thumb"
              />
            </div>
            <div class="col-3">
              <img
                src="{{ asset('images/product-images/healing-potion/healing-potion-product-2.png') }}"
                alt="Healing Potion — img 2"
                class="ps-gallery-thumb"
              />
            </div>
            <div class="col-3">
              <img
                src="{{ asset('images/product-images/healing-potion/healing-potion-product-3.png') }}"
                alt="Healing Potion — img 3"
                class="ps-gallery-thumb"
              />
            </div>
            <div class="col-3">
              <img
                src="{{ asset('images/product-images/healing-potion/healing-potion-product-1.png') }}"
                alt="Healing Potion — img 4"
                class="ps-gallery-thumb"
              />
            </div>
          </div>
        </div>

        {{-- Description --}}
        <div class="col-12 col-lg-7">
          <h1 class="ps-product-title mb-2">Healing Potion</h1>
          <p class="ps-font-lg text-ps-black-60 mb-4">
            <strong>25 Gold</strong>
          </p>

          <h2 class="ps-font-xl mb-3">Description</h2>
          <p class="ps-font-lg text-ps-grey mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac
            mattis ex, sit amet convallis justo. Cras pharetra massa ut
            suscipit cursus. Curabitur porttitor lacus eu nulla mollis, non
            efficitur massa varius. Nunc faucibus finibus scelerisque purus
            eget gravida. Nullam blandit posuere aliquam. Aenean et tempus
            erat. Duis nec quam lectus.
          </p>

          {{-- Quantity selector and add to cart --}}
          <form
            action="{{ url('/cart') }}"
            method="get"
            class="d-flex align-items-center gap-3 mt-4"
          >
            <fieldset class="ps-qty-stepper">
              <legend class="visually-hidden">Quantity</legend>
              <button type="button" aria-label="Decrease quantity">−</button>
              <input
                type="number"
                name="quantity"
                value="1"
                min="1"
                max="99"
                aria-label="Quantity"
              />
              <button type="button" aria-label="Increase quantity">+</button>
            </fieldset>
            <button
              type="submit"
              name="action"
              value="add_to_cart"
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
            Reviews (12)
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
          <p class="ps-font-base text-ps-black-60">
            Curabitur non nulla sit amet nisl tempus convallis quis ac
            lectus. Vivamus magna justo, lacinia eget consectetur sed,
            convallis at tellus. Praesent sapien massa, convallis a
            pellentesque nec, egestas non nisi.
          </p>
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
        <div class="col-6 col-md-3" style="min-width: 280px">
          <div class="card border-0">
            <div class="card-body">
              <div class="bg-light mb-3 rounded" style="height: 200px"></div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title mb-1">Speed</h5>
                  <p class="card-text text-muted mb-0">Potion</p>
                </div>
                <button class="btn btn-primary">Learn more</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3" style="min-width: 280px">
          <div class="card border-0">
            <div class="card-body">
              <div class="bg-light mb-3 rounded" style="height: 200px"></div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title mb-1">Speed</h5>
                  <p class="card-text text-muted mb-0">Potion</p>
                </div>
                <button class="btn btn-primary">Learn more</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3" style="min-width: 280px">
          <div class="card border-0">
            <div class="card-body">
              <div class="bg-light mb-3 rounded" style="height: 200px"></div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title mb-1">Speed</h5>
                  <p class="card-text text-muted mb-0">Potion</p>
                </div>
                <button class="btn btn-primary">Learn more</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3" style="min-width: 280px">
          <div class="card border-0">
            <div class="card-body">
              <div class="bg-light mb-3 rounded" style="height: 200px"></div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title mb-1">Speed</h5>
                  <p class="card-text text-muted mb-0">Potion</p>
                </div>
                <button class="btn btn-primary">Learn more</button>
              </div>
            </div>
          </div>
        </div>
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
