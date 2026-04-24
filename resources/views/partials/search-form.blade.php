<div class="{{ $wrapperClass }}" x-data="searchDropdown()" @click.outside="results = []">
  <form role="search" method="GET" action="{{ url('/shop') }}">
    <div class="input-group">
      <input
        class="ps-input"
        type="search"
        name="search"
        placeholder="Search for magical items..."
        aria-label="Search"
        value="{{ request('search') }}"
        x-model="query"
        @input.debounce.300ms="fetchResults"
        @focus="fetchResults"
        autocomplete="off"
      />
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </div>
  </form>
  <div class="ps-search-dropdown" x-show="results.length > 0" x-cloak>
    <template x-for="item in results" :key="item.id">
      <a :href="'/product/' + item.product_id" class="ps-search-item">
        <img :src="item.image ? ('/' + item.image) : '/images/potion-images/healing-potion.png'" :alt="item.name" />
        <span x-text="item.name"></span>
      </a>
    </template>
  </div>
</div>
