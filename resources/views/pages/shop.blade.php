@extends('layouts.main')

@section('title', 'Potion Spot - ' . $categoryName)


@section('content')
<div class="main-content shadow">
  <div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>

  <div class="shop-layout">

    <form method="GET" action="{{ url('/shop') }}" id="filter-form">
      @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}" />
      @endif
      @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}" />
      @endif

      <div class="shop-sidebar accordion" id="sidebarAccordion">

        <div class="accordion-item border-0">
          <h2 class="accordion-header">
            <button
              class="accordion-button category-title-btn"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#effectCollapse"
              aria-expanded="true"
              aria-controls="effectCollapse"
            >
              Effect
            </button>
          </h2>
          <div id="effectCollapse" class="accordion-collapse collapse show">
            <div class="accordion-body p-0">
              <div class="category-options">
                @foreach($effects as $effect)
                  <div class="category-option">
                    <input
                      type="checkbox"
                      id="effect-{{ Str::slug($effect) }}"
                      name="effects[]"
                      value="{{ $effect }}"
                      {{ in_array($effect, request('effects', [])) ? 'checked' : '' }}
                      onchange="document.getElementById('filter-form').submit()"
                    />
                    <label for="effect-{{ Str::slug($effect) }}">{{ $effect }}</label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item border-0">
          <h2 class="accordion-header">
            <button
              class="accordion-button category-title-btn"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#gradeCollapse"
              aria-expanded="true"
              aria-controls="gradeCollapse"
            >
              Grade
            </button>
          </h2>
          <div id="gradeCollapse" class="accordion-collapse collapse show">
            <div class="accordion-body p-0">
              <div class="category-options">
                @foreach($grades as $grade)
                  <div class="category-option">
                    <input
                      type="checkbox"
                      id="grade-{{ Str::slug($grade) }}"
                      name="grades[]"
                      value="{{ $grade }}"
                      {{ in_array($grade, request('grades', [])) ? 'checked' : '' }}
                      onchange="document.getElementById('filter-form').submit()"
                    />
                    <label for="grade-{{ Str::slug($grade) }}">{{ $grade }}</label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="accordion-item border-0">
          <h2 class="accordion-header">
            <button
              class="accordion-button category-title-btn"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#priceCollapse"
              aria-expanded="true"
              aria-controls="priceCollapse"
            >
              Price
            </button>
          </h2>
          <div id="priceCollapse" class="accordion-collapse collapse show">
            <div class="accordion-body p-0">
              <div class="category-options">
                <div class="px-2 py-2">
                  <div class="d-flex gap-2 align-items-center">
                    <input
                      type="number"
                      name="price_min"
                      class="ps-input"
                      placeholder="Min"
                      value="{{ request('price_min') }}"
                      min="0"
                    />
                    <span>—</span>
                    <input
                      type="number"
                      name="price_max"
                      class="ps-input"
                      placeholder="Max"
                      value="{{ request('price_max') }}"
                      min="0"
                    />
                  </div>
                  <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Go</button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </form>

    <div class="shop-content">

      <button class="btn btn-outline-primary d-lg-none mb-3" id="sidebarToggle">
        Filters
      </button>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">{{ $categoryName }}</h1>

        @php
          $currentSort = request('sort', '');
          $sortDefs = [
            'price'   => ['label' => 'Price',   'asc' => 'price_asc',   'desc' => 'price_desc'],
            'orders'  => ['label' => 'Orders',  'asc' => 'orders_asc',  'desc' => 'orders_desc'],
            'reviews' => ['label' => 'Reviews', 'asc' => 'reviews_asc', 'desc' => 'reviews_desc'],
          ];
        @endphp

        <div class="d-flex align-items-center gap-2 d-none d-md-flex">
          Sort by:
          @foreach($sortDefs as $def)
            @php
              $isAsc    = $currentSort === $def['asc'];
              $isDesc   = $currentSort === $def['desc'];
              $isActive = $isAsc || $isDesc;
              $nextSort = $isAsc ? $def['desc'] : $def['asc'];
              $arrow    = $isAsc ? ' ↑' : ($isDesc ? ' ↓' : '');
            @endphp
            <a href="{{ request()->fullUrlWithQuery(['sort' => $nextSort]) }}"
               class="btn {{ $isActive ? 'btn-dark' : 'btn-outline-dark' }}">
              {{ $def['label'] }}{{ $arrow }}
            </a>
          @endforeach
          <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="btn btn-outline-dark">Clear</a>
        </div>

        <div class="dropdown d-md-none">
          <button
            class="btn btn-outline-dark dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Sort by
          </button>
          <ul class="dropdown-menu">
            @foreach($sortDefs as $def)
              @php
                $isAsc    = $currentSort === $def['asc'];
                $isDesc   = $currentSort === $def['desc'];
                $nextSort = $isAsc ? $def['desc'] : $def['asc'];
                $arrow    = $isAsc ? ' ↑' : ($isDesc ? ' ↓' : '');
              @endphp
              <li>
                <a href="{{ request()->fullUrlWithQuery(['sort' => $nextSort]) }}" class="dropdown-item">
                  {{ $def['label'] }}{{ $arrow }}
                </a>
              </li>
            @endforeach
            <li>
              <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="dropdown-item">Clear</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="shop-products-container">
        @forelse($products as $product)
          <div class="shop-product-card">
            <div class="card">
              <div class="card-body">
                <img
                  src="{{ asset($product->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
                  alt="{{ $product->name }}"
                  class="card-img-top mb-3"
                  style="height: 200px; object-fit: contain"
                />
                <div class="d-flex justify-content-between align-items-center">
                  <div class="text-start">
                    <h5 class="card-title mb-1">{{ $product->name }}</h5>
                    <p class="card-text fs-5 mb-0">{{ $product->price }} Gold</p>
                    <span class="badge ps-grade-{{ Str::slug($product->grade) }}">{{ $product->grade }}</span>
                  </div>
                  <a href="{{ url('/product/' . $product->id) }}" class="btn btn-primary">Buy</a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <p class="text-muted py-4">No products found.</p>
        @endforelse
      </div>

      @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
          {{ $products->links('pagination::bootstrap-5') }}
        </div>
      @endif

    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.querySelector(".shop-sidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    function updateOverlay() {
      if (sidebar && !sidebar.classList.contains("hidden")) {
        sidebarOverlay.classList.add("show");
      } else {
        sidebarOverlay.classList.remove("show");
      }
    }

    if (sidebarToggle && sidebar) {
      if (window.innerWidth < 992) {
        sidebar.classList.add("hidden");
      }

      sidebarToggle.addEventListener("click", function () {
        sidebar.classList.toggle("hidden");
        updateOverlay();
      });

      if (sidebarOverlay) {
        sidebarOverlay.addEventListener("click", function () {
          sidebar.classList.add("hidden");
          updateOverlay();
        });
      }

      window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
          sidebar.classList.remove("hidden");
        } else {
          sidebar.classList.add("hidden");
        }
        updateOverlay();
      });
    }
  });
</script>
@endpush
