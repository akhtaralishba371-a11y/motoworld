<header class="mp-slim-header">
  <div class="mp-slim-inner">
    <a class="mp-slim-logo" href="{{ route('home') }}">MOT<span>OPARTS</span>.IE</a>
    <nav class="mp-slim-nav">
      <a href="{{ route('shop.index') }}">Shop</a>
      <a href="{{ route('cart') }}">Cart @if(isset($cartCount) && $cartCount > 0)<span class="mp-badge">{{ $cartCount }}</span>@endif</a>
      <a href="{{ route('wishlist') }}">Wishlist</a>
    </nav>
  </div>
</header>
