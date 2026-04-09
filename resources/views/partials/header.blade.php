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
      <form class="w-100" role="search">
        <div class="input-group">
          <input
            class="ps-input"
            type="search"
            placeholder="Search for magical items..."
            aria-label="Search"
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
          <li><a class="dropdown-item" href="#">Potions</a></li>
          <li><a class="dropdown-item" href="#">Scrolls</a></li>
          <li><a class="dropdown-item" href="#">Orbs</a></li>
          <li><a class="dropdown-item" href="#">Artifacts</a></li>
          <li><a class="dropdown-item" href="#">Bundles</a></li>
          <li><a class="dropdown-item" href="#">Sale</a></li>
        </ul>
      </div>
    </div>

    <form class="ps-header-search" role="search">
      <div class="input-group">
        <input
          class="ps-input"
          type="search"
          placeholder="Search for magical items..."
          aria-label="Search"
        />
        <button class="btn btn-outline-primary" type="submit">
          Search
        </button>
      </div>
    </form>

    <div class="ps-header-user-buttons">
      <a href="{{ url('/profile') }}" class="btn btn-light">
        <img src="{{ asset('images/user_resized.png') }}" />
        John Doe
      </a>

      <a href="{{ url('/cart') }}" class="btn btn-light">
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
        <li>
          <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('/profile') }}">
            <img src="{{ asset('images/user_resized.png') }}" style="width: 20px" />
            John Doe
          </a>
        </li>
        <li>
          <a
            class="dropdown-item d-flex align-items-center gap-2"
            href="{{ url('/cart') }}"
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
          <a class="nav-link" href="#">Potions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Scrolls</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Orbs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Artifacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Bundles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sale</a>
        </li>
      </ul>
    </nav>
  </div>
</div>
