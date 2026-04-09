@extends('layouts.main')

@section('title', 'Potion Spot - Admin')

@section('page_header')@endsection
@section('page_footer')@endsection

@section('content')
<div class="ps-banner-stripes d-flex justify-content-center align-items-center px-1 px-lg-4"></div>

<div class="container-fluid py-3 px-4 px-lg-5 ps-admin-header">
  <div class="d-flex flex-wrap gap-3 align-items-center">
    <h3 class="mb-0 me-3">Admin Panel</h3>

    <div class="ps-admin-actions d-none d-md-flex">
      <button
        class="btn btn-primary"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#addProductModal"
      >
        Add Product
      </button>
      <button
        class="btn btn-secondary"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#editProductModal"
      >
        Edit Product
      </button>
      <button
        class="btn btn-outline-danger"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#removeProductModal"
      >
        Remove Product
      </button>
    </div>

    <div class="dropdown d-md-none">
      <button
        class="btn btn-primary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        Actions
      </button>
      <ul class="dropdown-menu">
        <li>
          <button
            class="dropdown-item"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#addProductModal"
          >
            Add Product
          </button>
        </li>
        <li>
          <button
            class="dropdown-item"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#editProductModal"
          >
            Edit Product
          </button>
        </li>
        <li>
          <button
            class="dropdown-item"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#removeProductModal"
          >
            Remove Product
          </button>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="container my-5">
  <h2 class="ps-section-title">Product Catalogue</h2>
  <hr class="ps-section-divider" />
  <div class="ps-admin-filter-section mb-4">
    <div>
      <div class="input-group">
        <input
          class="ps-input"
          type="search"
          placeholder="Search products..."
          aria-label="Search"
        />
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </div>
    </div>
    <div>
      <select class="form-select ps-input">
        <option value="">All Categories</option>
        <option value="potions">Potions</option>
        <option value="scrolls">Scrolls</option>
        <option value="orbs">Orbs</option>
        <option value="artifacts">Artifacts</option>
      </select>
    </div>
  </div>

  <div class="ps-admin-product-list">
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/healing-potion.png') }}" alt="Healing Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Healing Potion</h5>
              <p class="ps-admin-product-id">ID: POT-001</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">25 Gold</p>
              <p class="ps-admin-product-stock">Stock: 50</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/speed-potion.png') }}" alt="Speed Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Speed Potion</h5>
              <p class="ps-admin-product-id">ID: POT-002</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">30 Gold</p>
              <p class="ps-admin-product-stock">Stock: 35</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/fireresistance-potion.png') }}" alt="Fire Resistance Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Fire Resistance Potion</h5>
              <p class="ps-admin-product-id">ID: POT-003</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">40 Gold</p>
              <p class="ps-admin-product-stock">Stock: 25</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/restoration-potion.png') }}" alt="Restoration Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Restoration Potion</h5>
              <p class="ps-admin-product-id">ID: POT-004</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">35 Gold</p>
              <p class="ps-admin-product-stock">Stock: 40</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/mana-potion.png') }}" alt="Mana Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Mana Potion</h5>
              <p class="ps-admin-product-id">ID: POT-005</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">20 Gold</p>
              <p class="ps-admin-product-stock">Stock: 60</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/invisibility-potion.png') }}" alt="Invisibility Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Invisibility Potion</h5>
              <p class="ps-admin-product-id">ID: POT-006</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">50 Gold</p>
              <p class="ps-admin-product-stock">Stock: 15</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/strength-potion.png') }}" alt="Strength Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Strength Potion</h5>
              <p class="ps-admin-product-id">ID: POT-007</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">45 Gold</p>
              <p class="ps-admin-product-stock">Stock: 30</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card ps-admin-product-card">
      <div class="card-body ps-admin-product-body">
        <img class="ps-admin-product-img" src="{{ asset('images/potion-images/fortitude-potion.png') }}" alt="Fortitude Potion" />
        <div class="ps-admin-product-content">
          <div class="ps-admin-product-header">
            <div class="ps-admin-product-info">
              <h5 class="card-title mb-1">Fortitude Potion</h5>
              <p class="ps-admin-product-id">ID: POT-008</p>
            </div>
            <div class="ps-admin-product-details">
              <p class="ps-admin-product-price">55 Gold</p>
              <p class="ps-admin-product-stock">Stock: 20</p>
            </div>
          </div>
          <div class="ps-admin-product-actions">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeProductModal">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
