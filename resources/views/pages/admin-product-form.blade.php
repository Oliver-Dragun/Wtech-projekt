@extends('layouts.main')

@section('title', $product ? 'Edit Product' : 'Add Product')

@section('page_header')@endsection
@section('page_footer')@endsection

@section('content')
@php
  $isEdit = (bool) $product;
  $action = $isEdit ? route('admin.products.update', $product) : route('admin.products.store');
@endphp

<main class="login-container py-5">
  <section class="login-card border shadow" style="max-width: 640px;" aria-label="{{ $isEdit ? 'Edit product' : 'Add product' }}">
    <a href="{{ url('/admin') }}" class="login-card-close" aria-label="Close">&times;</a>
    <div class="text-center mb-4">
      <img class="logo py-2" src="{{ asset('images/logo_resized.png') }}" />
      <h2 class="mb-1">{{ $isEdit ? 'Edit Product' : 'Add Product' }}</h2>
      @if($isEdit)
        <p class="text-muted mb-0">ID: {{ $product->id }}</p>
      @endif
    </div>

    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
      @csrf
      @if($isEdit) @method('PATCH') @endif

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="ps-input" id="name" name="name"
               value="{{ old('name', $product->name ?? '') }}" required maxlength="255" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <div class="row g-2 mb-3">
        <div class="col-6">
          <label for="category_id" class="form-label">Category</label>
          <select class="form-select ps-input" id="category_id" name="category_id" required>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>
        <div class="col-6">
          <label for="grade" class="form-label">Grade</label>
          <select class="form-select ps-input" id="grade" name="grade" required>
            @foreach($grades as $g)
              <option value="{{ $g }}"
                {{ old('grade', $product->grade ?? 'Basic') === $g ? 'selected' : '' }}>
                {{ $g }}
              </option>
            @endforeach
          </select>
          <x-input-error :messages="$errors->get('grade')" class="mt-2" />
        </div>
      </div>

      <div class="row g-2 mb-3">
        <div class="col-6">
          <label for="effect" class="form-label">Effect</label>
          <input type="text" class="ps-input" id="effect" name="effect"
                 value="{{ old('effect', $product->effect ?? '') }}" required maxlength="63"
                 placeholder="e.g. Healing" />
          <x-input-error :messages="$errors->get('effect')" class="mt-2" />
        </div>
        <div class="col-6">
          <label for="price" class="form-label">Price (Gold)</label>
          <input type="number" class="ps-input" id="price" name="price" min="0" step="1"
                 value="{{ old('price', $product->price ?? '') }}" required />
          <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="ps-input" id="description" name="description" rows="4" required>{{ old('description', $product->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
      </div>

      @if($isEdit && $product->photos->isNotEmpty())
        <div class="mb-3">
          <label class="form-label">Existing images</label>
          <div class="d-flex flex-wrap gap-2">
            @foreach($product->photos as $photo)
              <div class="border rounded p-2 text-center" style="width: 130px;">
                <img src="{{ asset($photo->img) }}" alt=""
                     style="width: 100%; height: 90px; object-fit: contain; background:#f7f7f7;" />
                <div class="small text-muted mt-1">
                  {{ $photo->number === 0 ? 'Main' : '#' . $photo->number }}
                </div>
                <div class="form-check mt-1 d-flex justify-content-center gap-1">
                  <input class="form-check-input" type="checkbox"
                         id="rm{{ $photo->id }}" name="remove_photos[]" value="{{ $photo->id }}">
                  <label class="form-check-label small" for="rm{{ $photo->id }}">Remove</label>
                </div>
              </div>
            @endforeach
          </div>
          <small class="text-muted">First remaining image becomes the main image.</small>
        </div>
      @endif

      <div class="mb-4">
        <label for="photos" class="form-label">
          {{ $isEdit ? 'Add more images' : 'Product images' }}
        </label>
        <input type="file" class="ps-input" id="photos" name="photos[]"
               accept="image/*" multiple />
        <x-input-error :messages="$errors->get('photos.0')" class="mt-2" />
        <div id="photoPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3">
        {{ $isEdit ? 'Save Changes' : 'Create Product' }}
      </button>
      <a href="{{ url('/admin') }}" class="btn btn-outline-primary w-100">Cancel</a>
    </form>

    @if($isEdit)
      <hr class="my-4" />
      <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
            onsubmit="return confirm('Permanently delete this product and all its images?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger w-100">Delete Product</button>
      </form>
    @endif
  </section>
</main>

@push('scripts')
<script>
  // Live previews of newly selected files
  const input = document.getElementById('photos');
  const preview = document.getElementById('photoPreview');
  if (input && preview) {
    input.addEventListener('change', () => {
      preview.innerHTML = '';
      Array.from(input.files).forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const wrap = document.createElement('div');
        wrap.className = 'border rounded p-2 text-center';
        wrap.style.width = '130px';
        const img = document.createElement('img');
        img.style.cssText = 'width:100%;height:90px;object-fit:contain;background:#f7f7f7;';
        img.src = URL.createObjectURL(file);
        const label = document.createElement('div');
        label.className = 'small text-muted mt-1 text-truncate';
        label.title = file.name;
        label.textContent = file.name;
        wrap.appendChild(img);
        wrap.appendChild(label);
        preview.appendChild(wrap);
      });
    });
  }
</script>
@endpush
@endsection
