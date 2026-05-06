@extends('layouts.main')

@section('title', 'Potion Spot - Admin')

@section('page_header')@endsection
@section('page_footer')@endsection

@section('content')
<main>
<div class="ps-banner-stripes d-flex justify-content-center align-items-center px-1 px-lg-4"></div>

<header class="container-fluid py-3 px-4 px-lg-5 ps-admin-header">
  <div class="d-flex flex-wrap gap-3 align-items-center">
    <h3 class="mb-0 me-3">Admin Panel</h3>

    <div class="ps-admin-actions">
      <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        Add Product
      </a>
    </div>
  </div>
</header>

<section class="container my-5" aria-label="Product catalogue">
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <h2 class="ps-section-title">Product Catalogue</h2>
  <hr class="ps-section-divider" />
  <div class="ps-admin-filter-section mb-4">
    <div>
      <form method="GET" action="{{ url('/admin') }}" class="input-group">
        @if(request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}" />
        @endif
        <input
          class="ps-input"
          type="search"
          name="search"
          placeholder="Search products..."
          aria-label="Search"
          value="{{ request('search') }}"
        />
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
    <div>
      <form method="GET" action="{{ url('/admin') }}">
        @if(request('search'))
          <input type="hidden" name="search" value="{{ request('search') }}" />
        @endif
        <select class="form-select ps-input" name="category" onchange="this.form.submit()">
          <option value="">All Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </form>
    </div>
  </div>

  <div class="ps-admin-product-list">
    @forelse($products as $product)
      <div class="card ps-admin-product-card">
        <div class="card-body ps-admin-product-body">
          <img
            class="ps-admin-product-img"
            src="{{ asset($product->mainPhoto?->img ?? 'images/potion-images/healing-potion.png') }}"
            alt="{{ $product->name }}"
          />
          <div class="ps-admin-product-content">
            <div class="ps-admin-product-header">
              <div class="ps-admin-product-info">
                <h5 class="card-title mb-1">{{ $product->name }}</h5>
                <p class="ps-admin-product-id">ID: {{ $product->id }} &middot; {{ $product->effect }} &middot; <span class="badge ps-grade-{{ Str::slug($product->grade) }}">{{ $product->grade }}</span></p>
              </div>
              <div class="ps-admin-product-details">
                <p class="ps-admin-product-price">{{ $product->price }} Gold</p>
              </div>
            </div>
            <div class="ps-admin-product-actions">
              <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary btn-sm">Edit</a>
              <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                    onsubmit="return confirm('Delete &quot;{{ $product->name }}&quot;? This cannot be undone.');"
                    class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted py-4">No products found.</p>
    @endforelse
  </div>

  @if($products->hasPages())
    <nav class="d-flex justify-content-center mt-4" aria-label="Pagination">
      {{ $products->links('pagination::bootstrap-5') }}
    </nav>
  @endif
</section>
</main>
@endsection
