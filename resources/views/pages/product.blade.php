@extends('layouts.main')

@section('title', $product->name . ' | Potion Spot')

@section('content')
<main>
  <div class="container-lg my-4">
    <nav aria-label="Product path" class="mb-4">
      <ol class="ps-path-list">
        <li class="ps-path-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="ps-path-item">
          <a href="{{ url('/shop?category=' . $product->category_id) }}">{{ $product->category->name }}</a>
        </li>
        <li class="ps-path-item active" aria-current="page">
          {{ $product->name }}
        </li>
      </ol>
    </nav>

    <section aria-label="Product details" class="mb-5">
      <div class="row g-4 g-lg-5">
        <div class="col-12 col-lg-5">
          @php
            $fallback = 'images/potion-images/healing-potion.png';
            $allPhotos = collect([$product->mainPhoto])
                ->concat($product->photos->where('number', '>', 0)->values())
                ->filter()
                ->values();
            $photoUrls = $allPhotos->map(fn($p) => asset($p->img ?? $fallback))->values();
            $firstImg  = $photoUrls->first() ?? asset($fallback);
          @endphp

          <div x-data="{
            photos: {{ Js::from($photoUrls) }},
            active: '{{ $firstImg }}',
            offset: 0,
            get visible()  { return this.photos.slice(this.offset, this.offset + 4); },
            get canPrev()  { return this.offset > 0; },
            get canNext()  { return this.offset + 4 < this.photos.length; },
            prev() { if (this.canPrev) this.offset--; },
            next() { if (this.canNext) this.offset++; }
          }">
            <div class="ps-gallery-main mb-3">
              <img x-bind:src="active" alt="{{ $product->name }} main image" />
            </div>

            <div class="position-relative" x-show="photos.length > 0">
              <button
                x-show="canPrev"
                x-on:click="prev"
                class="btn btn-light border-0 shadow-sm position-absolute top-50 translate-middle-y p-0"
                style="width:28px;height:28px;left:-14px;z-index:1"
                aria-label="Previous"
              ><img src="{{ asset('images/arrow.png') }}" style="width:12px" /></button>

              <div class="row g-2">
                <template x-for="(url, i) in visible" :key="offset + i">
                  <div class="col-3">
                    <img
                      :src="url"
                      class="ps-gallery-thumb"
                      style="cursor:pointer"
                      x-on:click="active = url"
                      :style="active === url ? 'border-color:var(--ps-primary)' : ''"
                    />
                  </div>
                </template>
              </div>

              <button
                x-show="canNext"
                x-on:click="next"
                class="btn btn-light border-0 shadow-sm position-absolute top-50 translate-middle-y p-0"
                style="width:28px;height:28px;right:-14px;z-index:1"
                aria-label="Next"
              ><img src="{{ asset('images/arrow.png') }}" style="width:12px;transform:rotate(180deg)" /></button>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-7">
          <h1 class="ps-product-title mb-2">{{ $product->name }}</h1>
          <p class="ps-font-lg text-ps-black-60 mb-4">
            <strong>{{ $product->price }} Gold</strong>
          </p>

          <h2 class="ps-font-xl mb-3">Description</h2>
          <p class="ps-font-lg text-ps-grey mb-4">
            {{ $product->description }}
          </p>

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
            Reviews ({{ $product->reviews->count() }})
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
          <ul class="ps-font-base text-ps-black-60 mb-0">
            <li>Effect: {{ $product->effect }}</li>
            <li>Grade: {{ $product->grade }}</li>
          </ul>
        </div>
        <div
          class="tab-pane fade"
          id="reviews"
          role="tabpanel"
          aria-labelledby="reviews-tab"
        >
          <h3 class="ps-font-md fw-bold mb-3">Customer Reviews</h3>

          @if($product->reviews->isEmpty())
            <p class="ps-font-base text-ps-black-60">
              No reviews yet. Be the first to share your experience!
            </p>
          @else
            @foreach($product->reviews as $review)
              <div class="{{ $loop->last ? 'pb-3' : 'border-bottom pb-3 mb-3' }}">
                <div class="d-flex justify-content-between mb-1">
                  <span class="fw-bold ps-font-base">{{ $review->user->name }} {{ $review->user->surname }}</span>
                  <span class="text-ps-black-60 ps-font-sm">{{ \Carbon\Carbon::parse($review->date)->format('Y/m/d') }}</span>
                </div>
                <p class="text-warning mb-1" aria-label="Rating: {{ $review->rating }} out of 5">
                  @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $review->rating ? '★' : '☆' }}
                  @endfor
                </p>
                <p class="ps-font-base text-ps-black-60 mb-0">{{ $review->body }}</p>
              </div>
            @endforeach
          @endif

          <div class="mt-4 pt-3 border-top">
            @auth
              @if($userReview)
                <p class="ps-font-base text-ps-black-60 mb-0">You have already reviewed this product.</p>
              @else
                @if(session('review_error'))
                  <p class="text-danger ps-font-base mb-3">{{ session('review_error') }}</p>
                @endif
                <h4 class="ps-font-md fw-bold mb-3">Leave a Review</h4>
                <form action="/reviews" method="POST"
                  x-data="{ rating: 5, hover: 0 }">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}" />
                  <input type="hidden" name="rating" x-bind:value="rating" />

                  <div class="mb-3">
                    <label class="ps-checkout-label d-block mb-2">Your Rating</label>
                    <div class="d-flex gap-1" style="font-size: 28px; cursor: pointer; line-height: 1;">
                      @for($i = 1; $i <= 5; $i++)
                        <span
                          x-on:click="rating = {{ $i }}"
                          x-on:mouseenter="hover = {{ $i }}"
                          x-on:mouseleave="hover = 0"
                          x-text="(hover || rating) >= {{ $i }} ? '★' : '☆'"
                          class="text-warning"
                        ></span>
                      @endfor
                    </div>
                    @error('rating')<div class="text-danger ps-font-sm mt-1">{{ $message }}</div>@enderror
                  </div>

                  <div class="mb-3">
                    <label class="ps-checkout-label" for="review-body">Your Review</label>
                    <textarea
                      id="review-body"
                      name="body"
                      rows="4"
                      class="form-control mt-1 @error('body') is-invalid @enderror"
                      placeholder="Share your experience..."
                    >{{ old('body') }}</textarea>
                    @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>

                  <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
              @endif
            @else
              <p class="ps-font-base text-ps-black-60 mb-0">
                <a href="{{ route('login', ['redirect' => url()->current()]) }}">Sign in</a> to leave a review.
              </p>
            @endauth
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="container my-5">
    <h2 class="mb-4">Recommended for you</h2>
    @include('partials.product-slider', ['products' => $recommended])
  </div>
</main>
@endsection
