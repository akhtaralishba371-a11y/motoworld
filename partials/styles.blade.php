<style>
  .mp-slim-header { background: #f0eee9; border-bottom: 1px solid #e5e0d8; position: sticky; top: 0; z-index: 40; }
  .mp-slim-inner { max-width: 1200px; margin: 0 auto; padding: 14px 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
  .mp-slim-logo { font-family: 'Bebas Neue', sans-serif; font-size: 28px; text-decoration: none; color: #1a1612; letter-spacing: 1px; }
  .mp-slim-logo span { color: #e8271a; }
  .mp-slim-nav { display: flex; gap: 18px; align-items: center; flex-wrap: wrap; }
  .mp-slim-nav a { text-decoration: none; color: #3d3630; font-weight: 600; font-size: 14px; }
  .mp-slim-nav a:hover { color: #e8271a; }
  .mp-badge { background: #e8271a; color: #fff; font-size: 11px; padding: 2px 6px; border-radius: 999px; margin-left: 4px; vertical-align: middle; }
  .mp-slim-footer { margin-top: auto; border-top: 1px solid #e5e0d8; background: #faf8f5; padding: 24px 20px; font-size: 13px; color: #6b6560; }
  .mp-slim-footer .mp-slim-inner { justify-content: center; gap: 20px; }
  .mp-slim-footer a { color: #e8271a; text-decoration: none; }

  .shop-wrap { max-width: 1200px; margin: 0 auto; padding: 24px 20px 80px; font-family: 'DM Sans', system-ui, sans-serif; color: #1a1612; min-height: 60vh; }
  .shop-head { margin-bottom: 24px; }
  .shop-head h1 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 4vw, 2.75rem); letter-spacing: 1px; margin: 0 0 8px; }
  .shop-head p { color: #6b6560; margin: 0; }
  .shop-toolbar { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; margin-bottom: 20px; }
  .shop-toolbar label { font-size: 13px; font-weight: 600; display: block; margin-bottom: 4px; color: #3d3630; }
  .shop-toolbar input[type="search"] { min-width: 220px; padding: 10px 12px; border: 1px solid #e5e0d8; border-radius: 8px; }
  .shop-toolbar button { background: #e8271a; color: #fff; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; }
  .shop-cats { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
  .shop-cats a { text-decoration: none; font-size: 13px; padding: 8px 12px; border-radius: 999px; background: #f4f1ec; color: #1a1612; border: 1px solid #e5e0d8; }
  .shop-cats a:hover { border-color: #e8271a; color: #e8271a; }
  .shop-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 18px; }
  .shop-card { background: #fff; border: 1px solid #e5e0d8; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(26,22,18,.06); display: flex; flex-direction: column; }
  .shop-card-img { aspect-ratio: 4/3; background: #f4f1ec; display: block; }
  .shop-card-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .shop-card-body { padding: 14px 16px 16px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
  .shop-card-body a.title { text-decoration: none; color: #1a1612; font-weight: 700; font-size: 15px; line-height: 1.3; }
  .shop-card-body a.title:hover { color: #e8271a; }
  .shop-meta { font-size: 12px; color: #6b6560; }
  .shop-price { font-weight: 800; color: #e8271a; font-size: 18px; margin-top: auto; }
  .shop-card-cart-form { margin-top: 10px; }
  .btn-card-cart {
    width: 100%;
    background: #e8271a;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
  }
  .btn-card-cart:hover { filter: brightness(0.95); }
  .shop-pager { display: flex; gap: 10px; align-items: center; margin-top: 28px; flex-wrap: wrap; }
  .shop-pager a, .shop-pager span { padding: 8px 14px; border-radius: 8px; background: #f4f1ec; text-decoration: none; color: #1a1612; font-size: 14px; }
  .shop-pager a:hover { background: #ede9e3; }
  .shop-pager .cur { background: #e8271a; color: #fff; }
  .shop-pager .disabled { opacity: .45; pointer-events: none; }
  .prod-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: start; }
  @media (max-width: 880px) { .prod-layout { grid-template-columns: 1fr; } }
  .prod-visual { background: #fff; border: 1px solid #e5e0d8; border-radius: 12px; overflow: hidden; }
  .prod-visual img { width: 100%; display: block; }
  .prod-detail h1 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 4vw, 2.5rem); margin: 0 0 8px; letter-spacing: .5px; }
  .prod-sku { font-size: 13px; color: #6b6560; margin-bottom: 12px; }
  .prod-price { font-size: 28px; font-weight: 800; color: #e8271a; margin-bottom: 16px; }
  .prod-desc { color: #3d3630; line-height: 1.65; margin-bottom: 20px; white-space: pre-wrap; }
  .prod-actions { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 12px; }
  .prod-actions form { display: inline; }
  .btn-buy { background: #e8271a; color: #fff; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 15px; }
  .btn-buy:hover { filter: brightness(0.95); }
  .btn-ghost { background: #f4f1ec; color: #1a1612; border: 1px solid #e5e0d8; padding: 12px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; }
  .qty-input { width: 72px; padding: 10px; border-radius: 8px; border: 1px solid #e5e0d8; }
  .flash { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
  .flash.ok { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
  .flash.err { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
  .crumb { font-size: 13px; color: #6b6560; margin-bottom: 16px; }
  .crumb a { color: #e8271a; text-decoration: none; }
</style>
