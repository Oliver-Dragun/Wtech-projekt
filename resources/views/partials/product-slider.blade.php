@php
  $sliderItems = $products->map(fn($p) => [
    'id'    => $p->id,
    'name'  => $p->name,
    'price' => $p->price,
    'grade' => $p->grade,
    'slug'  => Str::slug($p->grade),
    'img'   => asset($p->mainPhoto?->img ?? 'images/potion-images/healing-potion.png'),
  ])->values();
@endphp

<div class="position-relative" x-data="{
  items: {{ Js::from($sliderItems) }},
  offset: 0,
  get visible()  { return this.items.slice(this.offset, this.offset + 4); },
  get canPrev()  { return this.offset > 0; },
  get canNext()  { return this.offset + 4 < this.items.length; },
  prev() { if (this.canPrev) this.offset -= 4; },
  next() { if (this.canNext) this.offset += 4; }
}">
  <button
    x-show="canPrev"
    x-on:click="prev"
    class="btn btn-light border-0 shadow-sm position-absolute top-50 translate-middle-y p-0"
    style="width:36px;height:36px;left:-18px;z-index:1"
    aria-label="Previous"
  ><img src="{{ asset('images/arrow.png') }}" style="width:16px" /></button>

  <div class="shop-products-container">
    <template x-for="item in visible" :key="item.id">
      <div class="shop-product-card">
        <div class="card">
          <div class="card-body">
            <img :src="item.img" :alt="item.name"
              class="card-img-top mb-3"
              style="height:200px;object-fit:contain" />
            <div class="d-flex justify-content-between align-items-center">
              <div class="text-start">
                <h5 class="card-title mb-1" x-text="item.name"></h5>
                <p class="card-text fs-5 mb-0" x-text="item.price + ' Gold'"></p>
                <span class="badge" :class="'ps-grade-' + item.slug" x-text="item.grade"></span>
              </div>
              <a :href="'/product/' + item.id" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
      </div>
    </template>
  </div>

  <button
    x-show="canNext"
    x-on:click="next"
    class="btn btn-light border-0 shadow-sm position-absolute top-50 translate-middle-y p-0"
    style="width:36px;height:36px;right:-18px;z-index:1"
    aria-label="Next"
  ><img src="{{ asset('images/arrow.png') }}" style="width:16px;transform:rotate(180deg)" /></button>
</div>
