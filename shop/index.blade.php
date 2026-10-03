@extends('layouts.app')

@section('title', 'Shop — MotoParts')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
@include('shop.partials.styles')
@endsection

@section('content')
@include('shop.partials.slim-header')
<div class="shop-wrap">
  <div class="crumb"><a href="{{ route('home') }}">Home</a> / Shop</div>
  <div class="shop-head">
    <h1>Shop catalog</h1>
    <p>Search and browse active parts. Categories are managed in admin.</p>
  </div>

  @if(session('status'))
    <div class="flash ok">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div class="flash err">{{ $errors->first() }}</div>
  @endif

  <form class="shop-toolbar" method="GET" action="{{ route('shop.index') }}">
    <div>
      <label for="q">Search</label>
      <input id="q" type="search" name="q" value="{{ request('q') }}" placeholder="Name, SKU, description" />
    </div>
    <div>
      <button type="submit">Search</button>
    </div>
  </form>

  @if($rootCategories->isNotEmpty())
    <div class="shop-cats">
      @foreach($rootCategories as $rc)
        <a href="{{ route('shop.category', $rc) }}">{{ $rc->name }}</a>
      @endforeach
    </div>
  @endif

  <div class="shop-grid">
    @forelse($products as $p)
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
          <div class="shop-meta">{{ $p->primaryCategory?->name ?? 'Parts' }}</div>
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
    @empty
      <p style="grid-column: 1/-1; color:#6b6560;">No products match your search.</p>
    @endforelse
  </div>

  @if($products->hasPages())
    <div class="shop-pager">
      @if($products->onFirstPage())
        <span class="disabled">Previous</span>
      @else
        <a href="{{ $products->previousPageUrl() }}">Previous</a>
      @endif
      <span class="cur">Page {{ $products->currentPage() }} / {{ $products->lastPage() }}</span>
      @if($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}">Next</a>
      @else
        <span class="disabled">Next</span>
      @endif
    </div>
  @endif
</div>
@include('shop.partials.slim-footer')
@endsection
