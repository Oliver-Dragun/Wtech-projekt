@extends('layouts.main')

@section('title', 'My Profile | Potion Spot')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">My Profile</h2>
  <hr class="mb-4" />

  <div class="card border shadow mb-4">
    <div class="card-header bg-white">
      <h5 class="mb-0">Account Information</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <p class="mb-2"><strong>Name:</strong> John Doe</p>
          <p class="mb-2"><strong>Email:</strong> john@example.com</p>
          <p class="mb-0"><strong>Phone:</strong> +123 234 567 890</p>
        </div>
        <div class="col-6">
          <p class="mb-0"><strong>Address:</strong></p>
          <p class="mb-0">123 Magic Street</p>
          <p class="mb-0">Wizard City</p>
        </div>
      </div>
    </div>
    <div class="card-footer bg-white">
      <a href="{{ url('/edit-profile') }}" class="btn btn-primary">Edit Profile</a>
    </div>
  </div>

  <h4 class="mb-3">My Orders</h4>
  <hr class="mb-3" />

  <div class="card border shadow mb-3 rounded-0" style="border-radius: 0 !important">
    <div class="card-body">
      <div class="d-flex flex-column flex-lg-row align-items-start gap-3">
        <img
          src="{{ asset('images/potion-images/healing-potion.png') }}"
          alt="Healing Potion"
          class="flex-shrink-0"
          style="height: 140px; width: 140px; object-fit: contain; background-color: white; border: 1px solid #e5e7eb;"
        />
        <div class="d-flex flex-row flex-grow-1 justify-content-between w-100">
          <div>
            <h5 class="mb-1">Healing Potion</h5>
            <p class="mb-2 text-muted">Order #1234</p>
            <p class="mb-1"><strong>Quantity:</strong> 3</p>
            <p class="mb-0"><strong>Price:</strong> 25 Gold</p>
          </div>
          <div class="text-end">
            <p class="mb-1 text-muted">2024/3-15</p>
            <p class="mb-1">Delivered</p>
            <p class="mb-2 fw-bold">75 Gold</p>
            <button class="btn btn-outline-primary">Review product</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border shadow mb-3 rounded-0" style="border-radius: 0 !important">
    <div class="card-body">
      <div class="d-flex flex-column flex-lg-row align-items-start gap-3">
        <img
          src="{{ asset('images/potion-images/speed-potion.png') }}"
          alt="Speed Potion"
          class="flex-shrink-0"
          style="height: 140px; width: 140px; object-fit: contain; background-color: white; border: 1px solid #e5e7eb;"
        />
        <div class="d-flex flex-row flex-grow-1 justify-content-between w-100">
          <div>
            <h5 class="mb-1">Speed Potion</h5>
            <p class="mb-2 text-muted">Order #1233</p>
            <p class="mb-1"><strong>Quantity:</strong> 5</p>
            <p class="mb-0"><strong>Price:</strong> 30 Gold</p>
          </div>
          <div class="text-end">
            <p class="mb-1 text-muted">2024/3/10</p>
            <p class="mb-1">Shipped</p>
            <p class="mb-2 fw-bold">150 Gold</p>
            <button class="btn btn-primary">Track Order</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border shadow mb-3 rounded-0" style="border-radius: 0 !important">
    <div class="card-body">
      <div class="d-flex flex-column flex-lg-row align-items-start gap-3">
        <img
          src="{{ asset('images/potion-images/restoration-potion.png') }}"
          alt="Restoration Potion"
          class="flex-shrink-0"
          style="height: 140px; width: 140px; object-fit: contain; background-color: white; border: 1px solid #e5e7eb;"
        />
        <div class="d-flex flex-row flex-grow-1 justify-content-between w-100">
          <div>
            <h5 class="mb-1">Restoration Potion</h5>
            <p class="mb-2 text-muted">Order #1232</p>
            <p class="mb-1"><strong>Quantity:</strong> 4</p>
            <p class="mb-0"><strong>Price:</strong> 50 Gold</p>
          </div>
          <div class="text-end">
            <p class="mb-1 text-muted">2024/3/5</p>
            <p class="mb-1">Processing</p>
            <p class="mb-2 fw-bold">200 Gold</p>
            <button class="btn btn-primary">Track Order</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
