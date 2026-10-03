@extends('layouts.app')

@section('title', ($product->name ?? 'Product').' — MotoParts')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
@include('shop.partials.styles')
@endsection

@section('content')
@include('shop.partials.slim-header')
<div class="shop-wrap" id="buy">
  <div class="crumb">
    <a href="{{ route('home') }}">Home</a> /
    <a href="{{ route('shop.index') }}">Shop</a> /
    @if($product->primaryCategory)
      <a href="{{ route('shop.category', $product->primaryCategory) }}">{{ $product->primaryCategory->name }}</a> /
    @endif
    {{ $product->name }}
  </div>

  @if(session('status'))
    <div class="flash ok">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div class="flash err">{{ $errors->first() }}</div>
  @endif

  <div class="prod-layout">
    <div class="prod-visual">
      @if($product->image)
        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image) }}" alt="{{ $product->name }}" />
      @else
        <img src="{{ asset('images/landinpage.jpg') }}" alt="{{ $product->name }}" />
      @endif
    </div>
    <div class="prod-detail">
      <h1>{{ $product->name }}</h1>
      @if($product->sku)
        <div class="prod-sku">SKU: {{ $product->sku }}</div>
      @endif
      <div class="prod-price">&euro;{{ number_format((float) $product->price, 2) }}</div>
      @if($product->description)
        <div class="prod-desc">{{ $product->description }}</div>
      @endif

      <div class="prod-actions">
        <form method="POST" action="{{ route('cart.add') }}">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}" />
          <input type="hidden" name="redirect_to" value="cart" />
          <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <label style="font-size:13px;">Qty</label>
            <input class="qty-input" type="number" name="qty" value="1" min="1" max="999" />
            <button type="submit" class="btn-buy">Add to cart</button>
          </div>

          @if($product->addons->isNotEmpty())
            <div style="margin-top:12px;padding:12px;border:1px solid #e5e0d8;border-radius:10px;background:#faf8f5;">
              <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#6b6560;margin-bottom:8px;">Sub Products / Add-ons</div>
              <div style="display:grid;gap:7px;">
                @foreach($product->addons as $addon)
                  @php
                    $addonImg = $addon->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($addon->image) : asset('images/landinpage.jpg');
                  @endphp
                  <label style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;font-size:13px;color:#3d3630;border:1px solid #e7e3de;border-radius:8px;background:#fff;padding:8px;">
                    <span style="display:flex;align-items:flex-start;gap:8px;">
                      <input type="checkbox" name="addon_product_ids[]" value="{{ $addon->id }}" style="margin-top:3px;">
                      <img src="{{ $addonImg }}" alt="{{ $addon->name }}" style="width:46px;height:46px;object-fit:cover;border-radius:6px;border:1px solid #eee;">
                      <span>
                        <span style="display:block;font-weight:700;line-height:1.2;">{{ $addon->name }}</span>
                        <span style="display:block;color:#6b6560;font-size:12px;line-height:1.35;">
                          {{ \Illuminate\Support\Str::limit($addon->description ?? 'Optional add-on item.', 70) }}
                        </span>
                      </span>
                    </span>
                    <b style="color:#e8271a;white-space:nowrap;">&euro;{{ number_format((float) $addon->price, 2) }}</b>
                  </label>
                @endforeach
              </div>
            </div>
          @endif
        </form>
        <form method="POST" action="{{ route('wishlist.toggle', $product) }}">
          @csrf
          <button type="submit" class="btn-ghost">Save to wishlist</button>
        </form>
      </div>

      @if($product->extraCategories->isNotEmpty())
        <p class="shop-meta" style="margin-top:12px;">Also listed under:
          @foreach($product->extraCategories as $xc)
            <a href="{{ route('shop.category', $xc) }}" style="color:#e8271a;">{{ $xc->name }}</a>@if(!$loop->last), @endif
          @endforeach
        </p>
      @endif
    </div>
  </div>

  @if($related->isNotEmpty())
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.75rem;margin:48px 0 16px;letter-spacing:1px;">Related</h2>
    <div class="shop-grid">
      @foreach($related as $p)
        <article class="shop-card">
          <a class="shop-card-img" href="{{ route('product.show', $p) }}">
            @if($p->image)
              <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($p->image) }}" alt="{{ $p->name }}" />
            @else
              <img src="{{ asset('images/landinpage.jpg') }}" alt="{{ $p->name }}" />
            @endif
          </a>
          <div class="shop-card-body">
            <a class="title" href="{{ route('product.show', $p) }}">{{ $p->name }}</a>
            <div class="shop-price">&euro;{{ number_format((float) $p->price, 2) }}</div>
            <form method="POST" action="{{ route('cart.add') }}" class="shop-card-cart-form">
              @csrf
              <input type="hidden" name="product_id" value="{{ $p->id }}" />
              <input type="hidden" name="qty" value="1" />
              <input type="hidden" name="redirect_to" value="cart" />
              <button type="submit" class="btn-card-cart">Add to cart</button>
            </form>
          </div>
        </article>
      @endforeach
    </div>
  @endif
</div>
@include('shop.partials.slim-footer')
@endsection
