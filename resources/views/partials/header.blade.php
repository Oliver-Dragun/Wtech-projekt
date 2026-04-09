<div class="ps-header">
  <div class="ps-banner-stripes ps-header-banner">
    <div class="ps-header-banner-left">
      <button type="button" class="btn btn-secondary">Contact</button>
      <button type="button" class="btn btn-secondary">About</button>
    </div>

    <button type="button" class="btn btn-secondary ps-header-banner-email">
      info@potionspot.com
    </button>
  </div>

  <div class="ps-header-main">
    <a href="{{ url('/') }}">
      <img class="ps-header-logo" src="{{ asset('images/logo_resized.png') }}" />
    </a>

    <div class="ps-header-mobile-controls">
      <form class="w-100" role="search" method="GET" action="{{ url('/shop') }}">
        <div class="input-group">
          <input
            class="ps-input"
            type="search"
            name="search"
            placeholder="Search for magical items..."
            aria-label="Search"
            value="{{ request('search') }}"
          />
          <button class="btn btn-outline-primary" type="submit">
            Search
          </button>
        </div>
      </form>
      <div class="dropdown">
        <button
          class="btn btn-outline-primary dropdown-toggle"
          type="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          Categories
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ url('/shop?category=1') }}">Potions</a></li>
          <li><a class="dropdown-item" href="{{ url('/shop?category=2') }}">Scrolls</a></li>
          <li><a class="dropdown-item" href="{{ url('/shop?category=3') }}">Orbs</a></li>
          <li><a class="dropdown-item" href="{{ url('/shop?category=4') }}">Artifacts</a></li>
          <li><a class="dropdown-item" href="{{ url('/shop?category=5') }}">Bundles</a></li>
          <li><a class="dropdown-item" href="{{ url('/shop?category=5') }}">Sale</a></li>
        </ul>
      </div>
    </div>

    <form class="ps-header-search" role="search" method="GET" action="{{ url('/shop') }}">
      <div class="input-group">
        <input
          class="ps-input"
          type="search"
          name="search"
          placeholder="Search for magical items..."
          aria-label="Search"
          value="{{ request('search') }}"
        />
        <button class="btn btn-outline-primary" type="submit">
          Search
        </button>
      </div>
    </form>

    <div class="ps-header-user-buttons">
      @auth
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('images/user_resized.png') }}" />
            {{ auth()->user()->name }}
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="{{ url('/profile') }}">Profile &amp; Orders</a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">Log Out</button>
              </form>
            </li>
          </ul>
        </div>
      @else
        <a href="{{ route('login') }}" class="btn btn-light">
          <img src="{{ asset('images/user_resized.png') }}" />
          Login
        </a>
      @endauth

      <a href="{{ route('cart.index') }}" class="btn btn-light">
        <img src="{{ asset('images/cart_resized.png') }}" />
        Cart
      </a>
    </div>

    <div class="dropdown ps-header-mobile-menu">
      <button
        class="btn btn-light dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        Menu
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        @auth
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('/profile') }}">
              <img src="{{ asset('images/user_resized.png') }}" style="width: 20px" />
              {{ auth()->user()->name }}
            </a>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item">Log Out</button>
            </form>
          </li>
        @else
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('login') }}">
              <img src="{{ asset('images/user_resized.png') }}" style="width: 20px" />
              Login
            </a>
          </li>
        @endauth
        <li>
          <a
            class="dropdown-item d-flex align-items-center gap-2"
            href="{{ route('cart.index') }}"
          >
            <img src="{{ asset('images/cart_resized.png') }}" style="width: 20px" />
            Cart
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="ps-header-nav">
    <nav class="navbar navbar-expand-lg py-0">
      <ul class="navbar-nav mx-auto gap-5">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop?category=1') }}">Potions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop?category=2') }}">Scrolls</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop?category=3') }}">Orbs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop?category=4') }}">Artifacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop?category=5') }}">Bundles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop?category=5') }}">Sale</a>
        </li>
      </ul>
    </nav>
  </div>
</div>
