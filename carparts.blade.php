@extends('layouts.app')

@section('title', $page->meta_title ?? 'MotoParts')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
<style>
:root {
  --red: #e8271a;
  --ink: #171412;
  --ink2: #5f5953;
  --line: #e4ddd5;
  --line2: #d4cfc7;
  --cream: #faf8f5;
  --cream2: #f4f1ec;
  --cream3: #ede9e3;
  --ink3: #6b6560;
  --ink4: #9e9893;
  --red-pale: #fff0ef;
  --red-pale2: #ffe4e2;
  --orange: #f97316;
  --shadow-md: 0 8px 32px rgba(26,22,18,0.10);
  --bg: #f5f2ed;
  --white: #fff;
  --soft: #faf8f5;
  --shadow-sm: 0 8px 24px rgba(20, 16, 12, 0.08);
  --shadow-lg: 0 24px 60px rgba(20, 16, 12, 0.14);
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
 font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--ink); line-height: 1.6;
  overflow-x: hidden;
}
.container { width: min(1240px, calc(100% - 48px)); margin: 0 auto; }

.site-header {
  position: sticky; top: 0; z-index: 50;
  background: rgba(245, 242, 237, 0.94);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--line);
}
.header-row {
  height: 74px;
  display: flex; align-items: center; gap: 16px;
}
.logo {
  text-decoration: none; color: var(--ink);
  font-family: 'Bebas Neue', sans-serif; font-size: 38px;
  letter-spacing: 1px;
}
.logo span { color: var(--red); }
.search {
  flex: 1; max-width: 520px; margin-left: 10px;
  height: 44px; border: 1.5px solid var(--line); border-radius: 999px;
  background: #fff; display: flex; align-items: center; overflow: hidden;
}
.search input {
  border: none; outline: none; background: transparent;
  width: 100%; height: 100%; padding: 0 16px; font-size: 14px;
}
.nav { margin-left: auto; display: flex; gap: 10px; }
.nav a {
  text-decoration: none; color: var(--ink2); font-size: 13px; font-weight: 700;
  padding: 8px 14px; border-radius: 999px; border: 1px solid transparent;
}
.nav a.active { color: #fff; background: var(--red); }
.nav a:not(.active):hover { border-color: var(--line); color: var(--ink); }

.acc-page {
  padding: 26px 0 62px;
  background: linear-gradient(180deg, #f4f2ee 0%, #f8f6f2 38%, #f7f5f1 100%);
}
.section {
  padding: 22px 0;
}
.section-head { display: flex; justify-content: space-between; align-items: end; margin-bottom: 16px; }
.section-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(38px, 4vw, 54px);
  letter-spacing: .7px;
  line-height: .95;
}
.section-sub { color: var(--ink2); font-size: 14px; }

.configurator {
  background: #fff;
  border: 1.5px solid var(--line);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}
.configurator-head {
  padding: 20px 24px 12px;
  border-bottom: 1px solid var(--line);
}
.configurator-head h1 {
  font-family: 'Bebas Neue', sans-serif;
  letter-spacing: .9px;
  font-size: clamp(34px, 4vw, 50px);
  line-height: .9;
}
.configurator-body {
  padding: 18px;
  background: #f7f5f1;
  display: grid;
  grid-template-columns: 268px minmax(0, 1fr);
  gap: 16px;
}
.config-filter {
  background: #fff;
  border: 1px solid var(--line2);
  border-radius: 14px;
  padding: 16px 14px;
  box-shadow: 0 8px 22px rgba(27, 20, 16, 0.08);
}
.filter-group { margin-bottom: 12px; }
.filter-group label {
  display: block;
  font-size: 12px;
  color: var(--ink2);
  margin-bottom: 6px;
  font-weight: 600;
}
.filter-input, .filter-select {
  width: 100%;
  height: 38px;
  border-radius: 10px;
  border: 1px solid var(--line2);
  background: #fbfaf8;
  color: var(--ink);
  padding: 0 12px;
  font-size: 13px;
  font-family: 'DM Sans', sans-serif;
  outline: none;
}
.filter-input:focus, .filter-select:focus {
  border-color: var(--red);
  box-shadow: 0 0 0 3px rgba(232,39,26,0.09);
}
.checklist { margin: 6px 0 0; display: grid; gap: 6px; }
.checklist label {
  margin: 0;
  font-size: 12px;
  color: var(--ink3);
  display: flex;
  align-items: center;
  gap: 8px;
}
.checklist input { accent-color: var(--red); }
.find-btn {
  width: 100%;
  height: 38px;
  border: none;
  border-radius: 999px;
  background: var(--red);
  color: #fff;
  font-size: 12px;
  letter-spacing: .09em;
  text-transform: uppercase;
  font-weight: 700;
  cursor: pointer;
}
.find-btn:hover { background: #c91f14; }

.config-stage {
  background: #fff;
  border: 1px solid var(--line2);
  border-radius: 14px;
  padding: 12px;
  box-shadow: 0 8px 22px rgba(27, 20, 16, 0.08);
}
.stage-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
}
.stage-top strong {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: .15em;
  color: #8f8881;
}
.stage-top .price {
  font-size: 12px;
  color: #8f8881;
}
.stage-top .price b {
  color: var(--red);
  margin-left: 4px;
}
.car-stage {
  border: 1px solid var(--line);
  border-radius: 12px;
  background: linear-gradient(180deg, #fefefe 0%, #f3f0eb 100%);
  min-height: 372px;
  position: relative;
  overflow: hidden;
}
.car-stage img {
  position: absolute;
  width: min(660px, 96%);
  left: 50%;
  top: 50%;
  transform: translate(-50%, -46%);
  filter: drop-shadow(0 20px 24px rgba(16, 12, 10, 0.22));
}
.car-pin {
  position: absolute;
  width: 17px;
  height: 17px;
  border-radius: 50%;
  border: 4px solid rgba(232,39,26,0.2);
  background: var(--red);
    padding: 0;
  border-style: solid;
  cursor: pointer;
  transition: transform .2s, box-shadow .2s, filter .2s;
}
.car-pin:hover {
  transform: scale(1.08);
  filter: brightness(1.02);
}
.car-pin.active {
  box-shadow: 0 0 0 9px rgba(232,39,26,0.13);
  transform: scale(1.08);
}
.part-preview {
  margin-top: 10px;
  border: 1px solid var(--line);
  border-radius: 12px;
  background: linear-gradient(180deg, #fff 0%, #f8f5f0 100%);
  padding: 12px;
}
.part-preview-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 10px;
}
.part-preview-head strong {
  font-size: 14px;
  line-height: 1.3;
}
.part-preview-head span {
  color: var(--red);
  font-size: 17px;
  font-weight: 800;
}
.part-preview p {
  margin-top: 6px;
  font-size: 12px;
  color: var(--ink2);
}
.part-open-btn {
  margin-top: 10px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  height: 32px;
  padding: 0 14px;
  border-radius: 999px;
  background: var(--red);
  color: #fff;
  text-decoration: none;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .05em;
  text-transform: uppercase;
}
.part-open-btn:hover { background: #c91f14; }
.part-open-btn.is-hidden { display: none; }
.pin-1 { top: 26%; left: 22%; }
.pin-2 { top: 16%; left: 49%; }
.pin-3 { top: 34%; right: 37%; }
.pin-4 { bottom: 29%; left: 31%; }
.pin-5 { bottom: 18%; right: 29%; }

.config-tabs {
  margin-top: 14px;
  background: var(--red);
  border-radius: 10px;
  padding: 8px 12px;
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
}
.config-tabs span {
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
}

.quick-cats {
  margin-top: 24px;
  background: #fff;
  border: 1.5px solid var(--line);
  border-radius: 16px;
  box-shadow: var(--shadow-sm);
  padding: 16px;
}
.quick-grid {
  display: grid;
  grid-template-columns: repeat(10, minmax(96px, 1fr));
  gap: 10px;
}
.quick-item {
  border: 1px solid var(--line);
  border-radius: 12px;
  background: linear-gradient(180deg, #fff 0%, #f7f4ef 100%);
  text-align: center;
  padding: 10px 8px;
  min-height: 114px;
}
.quick-item img {
  width: 52px;
  height: 52px;
  object-fit: contain;
  filter: drop-shadow(0 8px 10px rgba(20, 12, 8, 0.14));
}
.quick-item p {
  margin-top: 8px;
  font-size: 11px;
  line-height: 1.3;
  font-weight: 600;
  color: var(--ink3);
}
.quick-item-extra { display: none; }
.quick-grid.is-expanded .quick-item-extra { display: block; }
.quick-toggle-wrap {
  margin-top: 14px;
  display: flex;
  justify-content: center;
}
.quick-toggle-btn {
  border: 1px solid var(--line2);
  background: #fff;
  color: var(--ink);
  border-radius: 999px;
  height: 34px;
  padding: 0 18px;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: .06em;
  font-weight: 700;
  cursor: pointer;
}
.quick-toggle-btn:hover {
  border-color: #c4bdb5;
  background: #f8f5f1;
}

.partner-band {
  margin-top: 24px;
  position: relative;
  background-image:
    linear-gradient(90deg, rgba(255,255,255,0.97) 0%, rgba(255,255,255,0.9) 38%, rgba(255,255,255,0.36) 62%, rgba(255,255,255,0.08) 80%),
    url('{{ asset('images/accesoriescar.jpg') }}');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border: 1.5px solid var(--line);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}
.partner-inner {
  display: grid;
  grid-template-columns: 1fr;
  align-items: center;
  gap: 10px;
  min-height: 320px;
  padding: 28px 30px;
}
.partner-copy h2 {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(34px, 4.2vw, 58px);
  line-height: .9;
  letter-spacing: .8px;
  max-width: 580px;
}
.partner-copy p {
  margin-top: 10px;
  color: var(--ink2);
  max-width: 500px;
}
.partner-btn {
  margin-top: 16px;
  border: none;
  border-radius: 999px;
  height: 40px;
  padding: 0 20px;
  background: var(--red);
  color: #fff;
  font-weight: 700;
  cursor: pointer;
}
.partner-btn:hover { background: #c91f14; }

.recently {
  margin-top: 26px;
}
.recent-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 12px;
}
.recent-card {
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 10px 22px rgba(20, 14, 11, 0.08);
}
.recent-media {
  height: 146px;
  background: #f3f0eb;
  display: grid;
  place-items: center;
}
.recent-media img {
  width: 98px;
  height: 98px;
  object-fit: contain;
}
.recent-body { padding: 12px; }
.recent-title {
  font-size: 14px;
  font-weight: 700;
  line-height: 1.25;
  margin-bottom: 8px;
}
.recent-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 6px;
}
.recent-price {
  font-size: 18px;
  font-weight: 800;
}
.recent-btn {
  border: none;
  height: 30px;
  padding: 0 12px;
  border-radius: 999px;
  background: var(--red);
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
}
.recent-btn:hover { background: #c91f14; }

/* ===== Index Header/Footer Sync ===== */
.site-header {
  position: sticky; top: 0; z-index: 100;
  background: #f0eee9;
  border-bottom: 1px solid var(--line);
  box-shadow: var(--shadow-sm);
  transition: box-shadow 0.3s;
}
.site-header.scrolled { box-shadow: var(--shadow-md); }

/* Top bar */
.brand-inner {
  max-width: 1360px; margin: 0 auto;
  padding: 0 28px;
  height: 72px;
  display: flex; align-items: center; gap: 20px;
  background: #f0eee9;
}

/* Logo ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â MOT?PARTS.IE */
.logo {
  text-decoration: none; display: flex;
  flex-direction: column; flex-shrink: 0;
}
.logo-main {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 30px; line-height: 1;
  letter-spacing: 1px;
  display: flex; align-items: center; gap: 0;
}
.logo-main .l-mot { color: var(--red); }
.logo-gear {
  width: 22px; height: 22px;
  display: inline-flex; align-items: center; justify-content: center;
  position: relative; top: 0;
}
.logo-gear svg, .logo-gear video { width: 22px; height: 22px; object-fit: contain; display: block; }
.logo-main .l-parts { color: var(--ink); }
.logo-main .l-dot { color: var(--red); }
.logo-main .l-ie { color: var(--ink); }
.logo-main .logo-video { height: 150px; width: auto; display: block; object-fit: contain; }
.logo-main--video .logo-fallback { align-items: center; gap: 0; font-family: 'Bebas Neue', sans-serif; font-size: 40px; letter-spacing: 1px; line-height: 1; }
.logo-sub {
  font-size: 8px; font-weight: 700;
  letter-spacing: 0.22em; text-transform: uppercase;
  color: var(--ink4); margin-top: 2px;
}

/* Divider */
.hdr-divider { width: 1px; height: 36px; background: var(--line2); flex-shrink: 0; margin: 0 4px; }

/* Search bar */
.search-wrap {
  flex: 1; max-width: 520px;
  display: flex; align-items: center;
  background: var(--white);
  border: 1.5px solid var(--line2);
  border-radius: 50px;
  overflow: hidden;
  transition: border-color .25s, box-shadow .25s;
}
.search-wrap:focus-within {
  border-color: var(--red);
  box-shadow: 0 0 0 3px rgba(232,39,26,0.09);
}
.search-icon-wrap {
  padding: 0 4px 0 16px;
  display: flex; align-items: center;
  color: var(--ink4);
}
.search-icon-wrap svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; }
.search-wrap input {
  flex: 1; height: 44px;
  background: transparent; border: none; outline: none;
  padding: 0 12px;
  font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--ink);
}
.search-wrap input::placeholder { color: var(--ink4); }
.search-btn {
  height: 36px; margin: 4px;
  padding: 0 22px;
  background: var(--red); border: none; border-radius: 50px;
  font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600;
  color: #fff; cursor: pointer;
  transition: background .2s, transform .15s;
  display: flex; align-items: center; gap: 6px;
}
.search-btn:hover { background: #c91f14; transform: scale(1.02); }
.search-btn svg { width: 13px; height: 13px; stroke: #fff; fill: none; stroke-width: 2.5; }

/* Icon group ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â Account / Wishlist / Cart */
.header-actions { display: flex; align-items: center; gap: 0; margin-left: auto; }
.hdr-icon-group {
  display: flex; align-items: center;
  border: 1.5px solid var(--line2);
  border-radius: 12px;
  background: var(--white);
  overflow: hidden;
}
.hdr-icon-btn {
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  gap: 3px; padding: 8px 16px;
  text-decoration: none; color: var(--ink2);
  font-size: 10px; font-weight: 600;
  letter-spacing: 0.04em;
  transition: color .2s, background .2s;
  position: relative; cursor: pointer;
  border: none; background: transparent; font-family: 'DM Sans', sans-serif;
  min-width: 68px;
}
.hdr-icon-btn + .hdr-icon-btn { border-left: 1px solid var(--line); }
.hdr-icon-btn:hover { color: var(--red); background: var(--red-pale); }
.hdr-icon-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 1.8; }
.hdr-icon-btn .hdr-badge {
  position: absolute; top: 6px; right: 14px;
  background: var(--red); color: #fff;
  font-size: 9px; font-weight: 700;
  width: 14px; height: 14px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  border: 1.5px solid var(--white);
}

.mobile-toggle {
  display: none; width: 44px; height: 44px;
  border-radius: 50%; border: 1.5px solid var(--line2);
  background: var(--white); align-items: center; justify-content: center;
  cursor: pointer; flex-direction: column; gap: 4px; margin-left: 10px;
}
.mobile-toggle span { display: block; width: 18px; height: 2px; background: var(--ink); border-radius: 2px; transition: all .3s; }

/* Nav belt */
.nav-belt {
  background: #f0eee9;
  border-top: 1px solid var(--line);
}
.nav-inner {
  max-width: 1360px; margin: 0 auto;
  padding: 0 28px; height: 44px;
  display: flex; align-items: center; justify-content: space-between;
}
.nav-left, .nav-right { display: flex; align-items: center; gap: 0; }

.nav-link, .nav-trigger {
  border: none; background: transparent;
  color: var(--ink2);
  font-family: 'DM Sans', sans-serif;
  font-size: 13.5px; font-weight: 500;
  height: 44px; padding: 0 14px;
  cursor: pointer;
  display: flex; align-items: center; gap: 4px;
  text-decoration: none;
  transition: color .2s; position: relative;
}
.nav-trigger svg { width: 10px; height: 10px; stroke: currentColor; fill: none; stroke-width: 2.5; transition: transform .2s; }
.nav-link:hover, .nav-trigger:hover { color: var(--red); }
.nav-trigger.active { color: var(--red); }
.nav-trigger.active svg { transform: rotate(180deg); }
.nav-trigger::after {
  content: ''; position: absolute;
  bottom: 0; left: 14px; right: 14px;
  height: 2px; background: var(--red);
  transform: scaleX(0); transition: transform .2s; border-radius: 2px;
}
.nav-trigger:hover::after, .nav-trigger.active::after { transform: scaleX(1); }

.nav-pills { display: flex; align-items: center; gap: 8px; }
.nav-pill-blog {
  background: #f0eee9; border: 1.5px solid var(--line2);
  color: var(--ink2); font-family: 'DM Sans', sans-serif;
  font-size: 13px; font-weight: 600;
  padding: 5px 16px; border-radius: 50px; cursor: pointer;
  transition: all .2s;
}
.nav-pill-blog:hover { border-color: var(--ink2); background: var(--white); }

.nav-pill-offers {
  background: var(--red); border: none;
  color: #fff; font-family: 'DM Sans', sans-serif;
  font-size: 13px; font-weight: 700;
  padding: 5px 16px; border-radius: 50px; cursor: pointer;
  display: flex; align-items: center; gap: 5px;
  transition: all .2s;
}
.nav-pill-offers:hover { background: #c91f14; transform: translateY(-1px); }
/* Offer popup */
body.offer-popup-open { overflow: hidden; }
.offer-popup-overlay {
  position: fixed;
  inset: 0;
  z-index: 260;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: 86px 16px 24px;
  background: rgba(9, 12, 18, 0.66);
  backdrop-filter: blur(3px);
  -webkit-backdrop-filter: blur(3px);
  opacity: 0;
  pointer-events: none;
  transition: opacity .24s ease;
}
.offer-popup-overlay.open { opacity: 1; pointer-events: auto; }
.offer-popup-card {
  position: relative;
  width: min(440px, 100%);
  border-radius: 18px;
  border: 2px solid rgba(176, 28, 18, 0.58);
  background: linear-gradient(160deg, #f4f4f4 0%, #ffffff 45%, #f0f0f0 100%);
  box-shadow: 0 28px 54px rgba(0, 0, 0, 0.42), 0 0 26px rgba(186, 26, 17, 0.25);
  overflow: hidden;
  transform: translateY(14px) scale(0.97);
  transition: transform .24s cubic-bezier(0.22, 1, 0.36, 1);
}
.offer-popup-overlay.open .offer-popup-card { transform: translateY(0) scale(1); }
.offer-popup-card::before {
  content: '';
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: radial-gradient(circle at 0% 40%, rgba(232, 39, 26, 0.12), transparent 56%);
}
.offer-popup-close {
  position: absolute;
  top: 8px;
  right: 8px;
  z-index: 5;
  width: 30px;
  height: 30px;
  border: none;
  border-radius: 50%;
  background: #181818;
  color: #fff;
  font-size: 18px;
  line-height: 1;
  cursor: pointer;
}
.offer-popup-body { position: relative; padding: 18px 18px 16px; }
.offer-popup-body > * { position: relative; z-index: 2; }
.offer-popup-title {
  margin: 0 28px 8px 0;
  font-family: 'Bebas Neue', sans-serif;
  letter-spacing: 0.02em;
  line-height: 1.04;
  font-size: clamp(33px, 6.3vw, 46px);
  color: #1b1b1b;
}
.offer-popup-title span { color: #b41f15; }
.offer-popup-copy {
  margin: 0 0 10px;
  color: #2e2e2e;
  font-size: 13.5px;
  line-height: 1.45;
  max-width: 290px;
}
.offer-popup-percent {
  margin: 0;
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(58px, 11vw, 86px);
  line-height: .85;
  color: #b61f15;
}
.offer-popup-promo {
  margin-top: 8px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.offer-popup-promo span {
  flex: 1;
  height: 40px;
  border: 1px solid #cfcfcf;
  border-radius: 10px;
  background: #fff;
  display: flex;
  align-items: center;
  padding: 0 12px;
  font-weight: 800;
  letter-spacing: .02em;
  color: #151515;
}
.offer-popup-copy-btn,
.offer-popup-apply,
.offer-popup-pass {
  border: none;
  border-radius: 999px;
  font-family: 'DM Sans', sans-serif;
  font-weight: 700;
  cursor: pointer;
}
.offer-popup-copy-btn {
  height: 40px;
  padding: 0 16px;
  font-size: 12px;
  background: linear-gradient(180deg, #e92c1d, #c11f13);
  color: #fff;
}
.offer-popup-row {
  margin-top: 12px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.offer-popup-time {
  min-width: 116px;
  padding: 8px 10px;
  border-radius: 12px;
  border: 1px solid #d7d7d7;
  background: #fff;
}
.offer-popup-time small {
  display: block;
  text-transform: uppercase;
  font-size: 9px;
  letter-spacing: 0.11em;
  color: #666;
}
.offer-popup-time b {
  display: block;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 44px;
  line-height: .83;
  color: #111;
}
.offer-popup-apply {
  flex: 1;
  height: 44px;
  background: linear-gradient(180deg, #e92c1d, #c11f13);
  color: #fff;
  font-size: 13px;
  letter-spacing: .03em;
}
.offer-popup-pass {
  flex: 1;
  height: 44px;
  background: #f2f2f2;
  border: 1px solid #d8d8d8;
  color: #474747;
  font-size: 12px;
}
.offer-popup-checkbox {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 10px;
  color: #555;
  font-size: 11px;
}
.offer-popup-checkbox input {
  width: 14px;
  height: 14px;
  accent-color: var(--red);
}
.offer-popup-wire {
  position: absolute;
  right: -6px;
  bottom: 6px;
  width: min(44%, 180px);
  opacity: .16;
  z-index: 1;
  pointer-events: none;
}

/* -- MEGA MENU -- */
.mega-root { position: relative; }
.mega-menu {
  position: absolute; top: 100%; left: 0; right: 0;
  background: var(--white);
  border-top: 1px solid var(--line);
  border-bottom: 3px solid var(--red);
  padding: 32px 0;
  opacity: 0; transform: translateY(-8px); pointer-events: none;
  transition: opacity .22s, transform .22s;
  box-shadow: var(--shadow-lg); z-index: 99;
}
.mega-menu.open { opacity: 1; transform: translateY(0); pointer-events: auto; }
.mega-inner { max-width: 1360px; margin: 0 auto; padding: 0 28px; }
.mega-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 24px; }
.group h4 {
  font-size: 10px; font-weight: 700;
  text-transform: uppercase; letter-spacing: 0.18em;
  color: var(--red); margin-bottom: 10px;
  padding-bottom: 8px; border-bottom: 1px solid var(--line);
}
.group ul { list-style: none; }
.group li { margin-bottom: 5px; }
.group a {
  color: var(--ink3); text-decoration: none;
  font-size: 13px; transition: color .2s, padding-left .2s; display: inline-block;
}
.group a:hover { color: var(--red); padding-left: 5px; }
.mobile-panel {
  display: none;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100vw;
  max-width: 100vw;
  background: var(--white);
  z-index: 200;
  transform: translateX(100%);
  transition: transform .35s cubic-bezier(0.22,1,0.36,1);
  overflow-y: auto;
  overflow-x: hidden;
  box-shadow: var(--shadow-lg);
}
.mobile-panel.open { transform: translateX(0); }
.mobile-panel-inner { display: block; width: 100%; min-height: 100%; }
.mobile-head { display: flex; align-items: center; justify-content: space-between; padding: 18px 24px; border-bottom: 1px solid var(--line); background: var(--cream); }
.mobile-logo {
  display: flex;
  align-items: center;
  color: var(--ink);
  line-height: 1;
}
.mobile-logo-video {
  height: 46px;
  width: auto;
  display: block;
  object-fit: contain;
}
.mobile-logo-fallback {
  display: inline-flex;
  align-items: center;
  gap: 0;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 30px;
  letter-spacing: 1px;
  line-height: 1;
}
.mobile-logo-fallback .ml-mot,
.mobile-logo-fallback .ml-dot { color: var(--red); }
.mobile-logo-fallback .ml-parts,
.mobile-logo-fallback .ml-ie { color: var(--ink); }
.mobile-close { width: 38px; height: 38px; background: var(--line); border: none; color: var(--ink); font-size: 16px; cursor: pointer; border-radius: 50%; transition: background .2s; }
.mobile-close:hover { background: var(--red); color: #fff; }
.mobile-search { padding: 14px 20px; border-bottom: 1px solid var(--line); }
.mobile-search input { width: 100%; height: 44px; background: var(--cream2); border: 1.5px solid var(--line2); border-radius: 50px; padding: 0 16px; color: var(--ink); font-family: 'DM Sans', sans-serif; font-size: 13px; outline: none; }
.mobile-item { border-bottom: 1px solid var(--line); }
.mobile-trigger { width: 100%; text-align: left; background: transparent; border: none; padding: 16px 24px; font-family: 'DM Sans', sans-serif; font-size: 16px; font-weight: 700; color: var(--ink); display: flex; align-items: center; justify-content: space-between; cursor: pointer; }
.mobile-trigger span { color: var(--red); font-size: 20px; }
.mobile-sub { display: none; padding: 4px 24px 14px; background: var(--cream); }
.mobile-sub.open { display: block; }
.mobile-sub a { display: block; padding: 9px 0; text-decoration: none; color: var(--ink3); font-size: 14px; border-bottom: 1px solid var(--line); transition: color .2s; }
.mobile-sub a:hover { color: var(--red); }
.mobile-sub a:last-child { border-bottom: none; }
.mobile-link-direct { text-decoration: none; }

/* ----------------------------------------
   FOOTER ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â matches image 2
   Dark carbon texture, floating parts images,
   glassmorphism cards, large 2025, pill bottom bar
---------------------------------------- */
.footer {
  position: relative;
  overflow: hidden;
  /* dark carbon/leather texture via CSS */
  background: #1a0e0c;
  background-image:
    repeating-linear-gradient(
      45deg,
      rgba(255,255,255,0.012) 0px,
      rgba(255,255,255,0.012) 1px,
      transparent 1px,
      transparent 8px
    ),
    repeating-linear-gradient(
      -45deg,
      rgba(255,255,255,0.012) 0px,
      rgba(255,255,255,0.012) 1px,
      transparent 1px,
      transparent 8px
    ),
    radial-gradient(ellipse 80% 60% at 10% 50%, rgba(180,20,10,0.18) 0%, transparent 60%),
    radial-gradient(ellipse 60% 40% at 90% 30%, rgba(150,10,5,0.12) 0%, transparent 55%),
    linear-gradient(160deg, #220c0a 0%, #1a0a08 40%, #120808 100%);
  padding: 56px 0 0;
}

/* Scattered auto parts ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â purely decorative background images via pseudo+spans */
.footer-parts-bg {
  position: absolute;
  inset: 0;
  pointer-events: none;
  overflow: hidden;
  z-index: 0;
}
.footer-part {
  position: absolute;
  opacity: 0.12;
  filter: grayscale(0.3) sepia(0.2);
  transform-origin: center;
}
/* Spark plug ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â top left */
.footer-part--sparkplug {
  left: 2%; top: 8%;
  width: 54px;
  animation: fp-float 7s ease-in-out infinite;
}
/* Shock absorber / spring ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â bottom left */
.footer-part--spring {
  left: 8%; bottom: 12%;
  width: 40px;
  animation: fp-float 9s 1s ease-in-out infinite;
}
/* Engine valve ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â mid left */
.footer-part--valve {
  left: 22%; top: 55%;
  width: 36px;
  animation: fp-float 8s 2s ease-in-out infinite;
}
/* Wrench ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â far right */
.footer-part--wrench {
  right: 2%; top: 15%;
  width: 48px;
  animation: fp-float 10s 0.5s ease-in-out infinite;
}
/* Gear ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â right mid */
.footer-part--gear {
  right: 8%; bottom: 18%;
  width: 52px;
  animation: fp-spin 14s linear infinite;
}
/* Ireland map outline silhouette ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢&euro;Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â bottom right card area */
.footer-map {
  position: absolute;
  right: 2%; bottom: 12%;
  width: 88px; height: 110px;
  opacity: 0.18;
  pointer-events: none;
  z-index: 0;
}

@keyframes fp-float {
  0%,100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-8px) rotate(4deg); }
}
@keyframes fp-spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

/* Red glow rim at top */
.footer::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--red), #ff5a4e, var(--red), transparent);
  z-index: 1;
}

/* Footer body */
.footer-body {
  max-width: 1360px; margin: 0 auto;
  padding: 0 32px 48px;
  position: relative; z-index: 2;
  display: grid;
  grid-template-columns: 1.5fr repeat(3, 1fr);
  gap: 20px;
  align-items: start;
}

/* Brand column */
.footer-brand-col { padding-right: 24px; }
.footer-logo {
  display: flex; flex-direction: column;
  margin-bottom: 18px;
}
.footer-logo-main {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 34px; line-height: 1; letter-spacing: 2px;
  color: var(--white);
  display: flex; align-items: center; gap: 0;
}
.footer-logo-main .fl-mot { color: var(--red); }
.footer-logo-gear {
  width: 26px; height: 26px;
  display: inline-flex; align-items: center; justify-content: center;
  animation: fp-spin 8s linear infinite;
}
.footer-logo-gear svg, .footer-logo-gear video { width: 26px; height: 26px; object-fit: contain; display: block; }
.footer-logo-main .fl-parts { color: var(--white); }
.footer-logo-main .fl-dot { color: var(--red); }
.footer-logo-main .fl-ie { color: var(--white); }
.footer-logo-main .footer-logo-video { height: 72px; width: auto; display: block; object-fit: contain; }
.footer-logo-main--video .footer-logo-fallback { align-items: center; gap: 0; display: inline-flex; }

.footer-brand-desc {
  font-size: 12.5px; line-height: 1.75;
  color: rgba(255,255,255,0.45);
  max-width: 240px;
}

/* Glass cards for Quick Links / Categories / Contact */
.footer-card {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.09);
  border-radius: 14px;
  padding: 22px 20px;
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  position: relative;
  overflow: hidden;
  transition: border-color .3s, background .3s;
}
.footer-card:hover {
  border-color: rgba(232,39,26,0.25);
  background: rgba(255,255,255,0.06);
}
/* Top red shimmer line */
.footer-card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, transparent, rgba(232,39,26,0.6), transparent);
  opacity: 0; transition: opacity .3s;
}
.footer-card:hover::before { opacity: 1; }

.footer-card h4 {
  font-size: 9px; font-weight: 800;
  letter-spacing: 0.22em; text-transform: uppercase;
  color: rgba(255,255,255,0.38);
  margin-bottom: 16px; padding-bottom: 10px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
}
.footer-card ul { list-style: none; }
.footer-card li { margin-bottom: 2px; }
.footer-card a {
  color: rgba(255,255,255,0.55);
  text-decoration: none; font-size: 13px;
  display: flex; align-items: center; gap: 6px;
  padding: 5px 0; transition: color .2s;
}
.footer-card a:hover { color: var(--red); }
/* Small icon for each link */
.footer-link-icon {
  width: 16px; height: 16px; flex-shrink: 0;
  opacity: 0.4; transition: opacity .2s;
}
.footer-card a:hover .footer-link-icon { opacity: 0.8; }
.footer-link-icon svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

/* Contact card specifics */
.footer-contact-item {
  display: flex; align-items: flex-start; gap: 8px;
  padding: 6px 0; font-size: 13px;
  color: rgba(255,255,255,0.55);
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
.footer-contact-item:last-child { border-bottom: none; }
.footer-contact-icon { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; opacity: 0.5; }
.footer-contact-icon svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }
.footer-contact-item a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color .2s; padding: 0; border: none; }
.footer-contact-item a:hover { color: var(--red); }

/* Footer bottom bar */
.footer-bottom {
  position: relative; z-index: 2;
  border-top: 1px solid rgba(255,255,255,0.07);
  padding: 18px 32px;
  max-width: 1360px; margin: 0 auto;
}
.footer-bottom-inner {
  display: flex; align-items: center; justify-content: space-between;
}
.footer-copyright {
  font-size: 11px; color: rgba(255,255,255,0.22);
}
.footer-year {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(42px, 5vw, 64px);
  line-height: 0.9;
  letter-spacing: 0.08em;
  color: rgba(255,255,255,0.14);
}
.footer-bottom-right {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 8px;
  flex-wrap: wrap;
}
.footer-pill {
  text-decoration: none;
  color: rgba(255,255,255,0.6);
  border: 1px solid rgba(255,255,255,0.15);
  background: rgba(255,255,255,0.04);
  border-radius: 999px;
  padding: 6px 12px;
  font-size: 11px;
  transition: color .2s, border-color .2s, background .2s;
}
.footer-pill:hover {
  color: #fff;
  border-color: rgba(232,39,26,0.45);
  background: rgba(232,39,26,0.16);
}
.footer-sparkle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.2);
  background: rgba(255,255,255,0.06);
  color: rgba(255,255,255,0.8);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: transform .2s, border-color .2s, color .2s;
}
.footer-sparkle:hover {
  transform: translateY(-2px);
  border-color: rgba(232,39,26,0.45);
  color: var(--red);
}
@media (max-width: 1200px) {
  .footer-body {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
  .footer-brand-col {
    grid-column: 1 / -1;
    max-width: 560px;
    padding-right: 0;
  }
}
@media (max-width: 760px) {
  .footer {
    padding-top: 44px;
  }
  .footer-body {
    grid-template-columns: 1fr;
    gap: 14px;
    padding: 0 18px 32px;
  }
  .footer-brand-col {
    max-width: none;
  }
  .footer-card {
    padding: 18px 16px;
  }
  .footer-bottom {
    padding: 16px 18px 22px;
  }
  .footer-bottom-inner {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }
  .footer-year {
    font-size: 36px;
    letter-spacing: 0.06em;
  }
  .footer-bottom-right {
    width: 100%;
    justify-content: flex-start;
  }
  .footer-sparkle {
    margin-left: auto;
  }
  .footer-part,
  .footer-map {
    display: none;
  }
}
@media (max-width: 640px) {
  .brand-inner { padding: 0 12px; gap: 8px; height: 64px; }
  .hdr-divider { display: none; }
  .nav-inner { padding: 0 12px; }
  .logo-main .logo-video { height: 42px; }
  .logo-main--video .logo-fallback { font-size: 30px; }
  .logo-sub { display: none; }
  .header-actions { margin-left: auto; gap: 8px; }
  .hdr-icon-btn { min-width: 50px; padding: 7px 10px; }
  .hdr-icon-btn svg { width: 16px; height: 16px; }
  .hdr-icon-btn .hdr-badge { top: 4px; right: 8px; }
  .hdr-icon-btn .hdr-icon-label { display: none; }
  .mobile-toggle { width: 40px; height: 40px; margin-left: 6px; }
}
@media (max-width: 500px) {
  .brand-inner { padding: 0 8px; gap: 6px; height: 60px; }
  .nav-inner { padding: 0 8px; }
  .logo-main .logo-video { height: 36px; }
  .logo-main--video .logo-fallback { font-size: 24px; }
  .hdr-icon-group { border-width: 1px; }
  .hdr-icon-btn { min-width: 40px; padding: 6px 7px; gap: 2px; }
  .hdr-icon-btn svg { width: 15px; height: 15px; }
  .hdr-icon-btn .hdr-badge { top: 3px; right: 5px; width: 12px; height: 12px; font-size: 8px; }
  .mobile-toggle { width: 36px; height: 36px; margin-left: 4px; }
  .nav-pills { gap: 6px; }
  .nav-pill-blog, .nav-pill-offers { font-size: 11px; padding: 4px 10px; }
  .mobile-head { padding: 14px 12px; }
  .mobile-search { padding: 10px 12px; }
  .mobile-trigger { padding: 14px 12px; }
  .mobile-sub { padding: 4px 12px 12px; }
  .mobile-logo-video { height: 100px; }
  .mobile-logo-fallback { font-size: 24px; }
  .mobile-close { width: 34px; height: 34px; font-size: 15px; }
}
@media (max-width: 1024px) { .search-wrap { display: none; } .nav-left, .nav-right { display: none; } .mobile-toggle { display: flex; } .mobile-panel { display: flex; } }
@media (max-width: 640px) {
  .logo-main .logo-video { height: 50px; }
  .logo-main--video .logo-fallback { font-size: 37px; }
  .logo-sub { font-size: 7px; letter-spacing: .14em; } .hdr-icon-btn .hdr-icon-label { display: none; } }

@media (max-width: 1080px) {
  .configurator-body { grid-template-columns: 1fr; }
  .quick-grid { grid-template-columns: repeat(5, minmax(0, 1fr)); }
  .partner-inner { grid-template-columns: 1fr; }
  .recent-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 680px) {
  .container { width: min(1240px, calc(100% - 28px)); }
  .header-row { height: auto; padding: 12px 0; flex-wrap: wrap; }
  .search { order: 3; width: 100%; max-width: none; margin-left: 0; }
  .configurator-head { padding: 16px 16px 10px; }
  .configurator-body { padding: 12px; }
  .car-stage { min-height: 240px; }
  .config-tabs { gap: 10px; }
  .quick-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .partner-inner { padding: 18px; }
  .partner-band {
    background-image:
      linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.88) 52%, rgba(255,255,255,0.62) 100%),
      url('{{ asset('images/accesoriescar.jpg') }}');
    background-position: right center;
  }
  .partner-inner { min-height: 280px; }
  .recent-grid { grid-template-columns: 1fr; }
}
</style>
<style>
/* Mobile image visibility hotfix */
@media (max-width: 768px) {
  img, video { max-width: 100%; }
  .hero-panel.hero-image-panel {
    display: flex !important;
    min-height: 220px !important;
    margin-top: 12px;
  }
  .hero-image-panel img,
  .hero-image-panel video {
    width: 100% !important;
    height: auto !important;
    max-height: none !important;
    object-fit: contain !important;
    transform: none !important;
  }
  .blogs-featured img,
  .blog-card-thumb img,
  .product-img img,
  .parts-img-side img,
  .fitment-visual img,
  .wish-item-thumb img,
  .cart-item img,
  .veh-thumb img,
  .recent-media img,
  .quick-item img,
  .blogs-trending-image {
    width: 100% !important;
    height: auto !important;
    object-fit: contain !important;
    transform: none !important;
  }
  .blogs-featured,
  .blog-card-thumb,
  .product-img,
  .parts-img-side,
  .fitment-visual,
  .wish-item-thumb,
  .cart-item,
  .veh-thumb,
  .recent-media,
  .quick-item,
  .blogs-trending-image-wrap {
    height: auto !important;
    min-height: 0 !important;
  }
}
</style>
@endsection

@section('content')
@include('layouts.header')
<div class="offer-popup-overlay" id="offerPopupOverlay" aria-hidden="true">
  <section class="offer-popup-card" role="dialog" aria-modal="true" aria-labelledby="offerPopupTitle">
    <button class="offer-popup-close" type="button" data-offer-close aria-label="Close offer">&times;</button>
    <div class="offer-popup-body">
      <h3 class="offer-popup-title" id="offerPopupTitle">Exclusive Garage Bonus: <span>15% OFF + Free Priority Shipping</span></h3>
      <p class="offer-popup-copy">Unlock a custom fitment guarantee and priority handling for your Porsche 911 GT3 parts when you finalize your order now.</p>
      <p class="offer-popup-percent">15%</p>
      <div class="offer-popup-promo">
        <span id="offerPopupCode">GT3_UNLOCK_15</span>
        <button class="offer-popup-copy-btn" type="button" id="offerPopupCopyBtn">COPY</button>
      </div>
      <div class="offer-popup-row">
        <div class="offer-popup-time">
          <small>Time Remaining:</small>
          <b id="offerPopupTimer">09:59</b>
        </div>
        <button class="offer-popup-apply" type="button" id="offerPopupApplyBtn">APPLY OFFER</button>
      </div>
      <div class="offer-popup-row">
        <button class="offer-popup-pass" type="button" data-offer-close>NO THANKS, I'LL PASS</button>
      </div>
      <label class="offer-popup-checkbox">
        <input type="checkbox" />
        <span>Apply fitment guarantee to my garage profile.</span>
      </label>
      <img class="offer-popup-wire" src="{{ asset('images/accounts2.webp') }}" alt="" aria-hidden="true" />
    </div>
  </section>
</div>

<main class="acc-page">
  <section class="section">
    <div class="container">
      <div class="configurator">
        <div class="configurator-head">
          <h1>Car Parts Configurator</h1>
        </div>
        <div class="configurator-body">
          <aside class="config-filter">
            <div class="filter-group">
              <label for="car-year">Select Vehicle</label>
              <select id="car-year" class="filter-select">
                <option>Year</option>
                <option>2026</option>
                <option>2025</option>
                <option>2024</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="car-make">Make</label>
              <select id="car-make" class="filter-select">
                <option>Select Make</option>
                <option>Toyota</option>
                <option>Honda</option>
                <option>BMW</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="car-model">Model</label>
              <select id="car-model" class="filter-select">
                <option>Select Model</option>
                <option>GR Supra</option>
                <option>Civic</option>
                <option>Corolla</option>
              </select>
            </div>
            <div class="filter-group">
              <label>Parts</label>
              <div class="checklist">
                @forelse(($filterProducts ?? collect()) as $fIndex => $filterProduct)
                  <label><input type="checkbox" {{ $fIndex < 3 ? 'checked' : '' }} /> {{ $filterProduct->name }}</label>
                @empty
                  <label><input type="checkbox" checked /> No related parts available</label>
                @endforelse
              </div>
            </div>
            <button class="find-btn" type="button">Search Parts</button>
          </aside>

          <div class="config-stage">
            <div class="stage-top">
              <strong>{{ isset($selectedCarPart) && $selectedCarPart ? 'Selected: '.$selectedCarPart->name : 'Pick The Car Parts You Need' }}</strong>
              <span class="price">Base Price <b>&euro;{{ isset($selectedCarPart) && $selectedCarPart ? number_format((float) $selectedCarPart->price, 2) : '0.00' }}</b></span>
            </div>
                                    <div class="car-stage">
              @php
                $selectedImg = isset($selectedCarPart) && $selectedCarPart && $selectedCarPart->image
                  ? \Illuminate\Support\Facades\Storage::disk('public')->url($selectedCarPart->image)
                  : asset('images/carparts.webp');
              @endphp
              <img src="{{ $selectedImg }}" alt="{{ isset($selectedCarPart) && $selectedCarPart ? $selectedCarPart->name : 'Configured car parts layout' }}" />
              @foreach(($configPins ?? collect()) as $pinIndex => $pinProduct)
                <button
                  class="car-pin pin-{{ $pinIndex + 1 }}"
                  type="button"
                  title="{{ $pinProduct->name }}"
                  aria-label="{{ $pinProduct->name }}"
                  data-product="{{ $pinProduct->name }}"
                  data-price="EUR {{ number_format((float) $pinProduct->price, 2) }}"
                  data-desc="{{ \Illuminate\Support\Str::limit($pinProduct->description ?? 'Part selected from configurator view.', 130) }}"
                  data-link="{{ route('tool-product', ['product_id' => $pinProduct->id]) }}"
                ></button>
              @endforeach
            </div>
            <div class="part-preview">
              <div class="part-preview-head">
                <strong data-part-name>{{ isset($selectedCarPart) && $selectedCarPart ? $selectedCarPart->name : 'Click the dot to view product details' }}</strong>
                <span data-part-price>{{ isset($selectedCarPart) && $selectedCarPart ? 'EUR '.number_format((float) $selectedCarPart->price, 2) : 'EUR 0.00' }}</span>
              </div>
              <p data-part-desc>{{ isset($selectedCarPart) && $selectedCarPart ? ($selectedCarPart->description ?? 'Selected product details are shown here.') : 'Click any red dot and product name, price, and details will appear here.' }}</p>
              <a data-part-open class="part-open-btn{{ isset($selectedCarPart) && $selectedCarPart ? '' : ' is-hidden' }}" href="{{ isset($selectedCarPart) && $selectedCarPart ? route('tool-product', ['product_id' => $selectedCarPart->id]) : '#' }}">Open Product</a>
            </div>
            <div class="config-tabs">
              <span>Engine Parts</span><span>Brake System</span><span>Suspension</span><span>Electrical</span><span>Cooling</span><span>Part Services</span>
            </div>
          </div>
        </div>
      </div>

      <div class="quick-cats" id="quick-cats-parts">
        <div class="quick-grid" id="quickGridParts">
          @forelse(($quickPartProducts ?? collect()) as $quickIndex => $quickProduct)
            @php
              $quickImg = $quickProduct->image
                ? \Illuminate\Support\Facades\Storage::disk('public')->url($quickProduct->image)
                : asset('images/icon.webp');
            @endphp
            <article class="quick-item{{ $quickIndex >= 10 ? ' quick-item-extra' : '' }}" data-product-url="{{ route('tool-product', ['product_id' => $quickProduct->id]) }}">
              <img src="{{ $quickImg }}" alt="{{ $quickProduct->name }}" />
              <p>{{ $quickProduct->name }}</p>
            </article>
          @empty
            <article class="quick-item"><img src="{{ asset('images/icon.webp') }}" alt="No car parts" /><p>No car parts selected yet</p></article>
          @endforelse
        </div>
        <div class="quick-toggle-wrap">
          <button id="quickGridToggleParts" class="quick-toggle-btn" type="button" aria-expanded="false">View More</button>
        </div>
      </div>

      <div class="partner-band">
        <div class="partner-inner">
          <div class="partner-copy">
            <h2>Your Trusted Partner For Genuine Car Parts</h2>
            <p>Find reliable replacement parts for every system in your vehicle, with fitment confidence and workshop-grade quality.</p>
            <button class="partner-btn" type="button">Shop Car Parts</button>
          </div>
        </div>
      </div>

      <section class="recently">
        <div class="section-head">
          <div>
            <div class="section-title">Recently Added Car Parts</div>
            <div class="section-sub">Latest engine, brake, electrical and suspension parts in stock.</div>
          </div>
        </div>
        <div class="recent-grid">
          @forelse(($quickPartProducts ?? collect())->take(4) as $recentProduct)
            @php
              $recentImg = $recentProduct->image
                ? \Illuminate\Support\Facades\Storage::disk('public')->url($recentProduct->image)
                : asset('images/icon.webp');
            @endphp
            <article class="recent-card" id="parts-product-{{ $recentProduct->id }}" data-product-url="{{ route('tool-product', ['product_id' => $recentProduct->id]) }}">
              <div class="recent-media"><img src="{{ $recentImg }}" alt="{{ $recentProduct->name }}" /></div>
              <div class="recent-body">
                <h3 class="recent-title">{{ $recentProduct->name }}</h3>
                <div class="recent-row">
                  <div class="recent-price">EUR {{ number_format((float) $recentProduct->price, 2) }}</div>
                  <button class="recent-btn" type="button">Add To Cart</button>
                </div>
              </div>
            </article>
          @empty
            <article class="recent-card">
              <div class="recent-media"><img src="{{ asset('images/icon.webp') }}" alt="No car parts found" /></div>
              <div class="recent-body">
                <h3 class="recent-title">No car parts found</h3>
                <div class="recent-row">
                  <div class="recent-price">EUR 0.00</div>
                </div>
              </div>
            </article>
          @endforelse
        </div>
      </section>
    </div>
  </section>
</main>

@include('layouts.footer')
@endsection

@section('page_scripts')
const siteHeader = document.getElementById('siteHeader');
if (siteHeader) {
  window.addEventListener('scroll', () => {
    siteHeader.classList.toggle('scrolled', window.scrollY > 6);
  });
}

const navTriggers = document.querySelectorAll('.nav-trigger');
const megaMenus = document.querySelectorAll('.mega-menu');
const megaRoot = document.getElementById('megaRoot');
const pageMap = {
  accessories: '{{ route('accessories') }}',
  carparts: '{{ route('carparts') }}',
  tools: '{{ route('tools') }}'
};

navTriggers.forEach(trigger => {
  trigger.addEventListener('mouseenter', () => {
    navTriggers.forEach(t => t.classList.remove('active'));
    megaMenus.forEach(m => m.classList.remove('open'));
    const target = document.getElementById('menu-' + trigger.dataset.menu);
    if (target) {
      target.classList.add('open');
      trigger.classList.add('active');
    }
  });

  trigger.addEventListener('click', () => {
    const nextPage = pageMap[trigger.dataset.menu];
    if (nextPage) {
      window.location.href = nextPage;
    }
  });
});
if (megaRoot) {
  megaRoot.addEventListener('mouseleave', () => {
    megaMenus.forEach(m => m.classList.remove('open'));
    navTriggers.forEach(t => t.classList.remove('active'));
  });
}

function setupConfiguratorPins() {
  document.querySelectorAll('.config-stage').forEach(stage => {
    const pins = stage.querySelectorAll('.car-pin[data-product]');
    const preview = stage.querySelector('.part-preview');
    if (!pins.length || !preview) return;

    const nameEl = preview.querySelector('[data-part-name]');
    const priceEl = preview.querySelector('[data-part-price]');
    const descEl = preview.querySelector('[data-part-desc]');
    const openBtn = preview.querySelector('[data-part-open]');

    pins.forEach(pin => {
      pin.addEventListener('click', () => {
        pins.forEach(p => p.classList.remove('active'));
        pin.classList.add('active');

        if (nameEl) nameEl.textContent = pin.dataset.product || 'Selected Part';
        if (priceEl) priceEl.textContent = pin.dataset.price || '.00';
        if (descEl) descEl.textContent = pin.dataset.desc || 'Part selected from configurator view.';

        if (openBtn) {
          openBtn.href = pin.dataset.link || '#';
          openBtn.classList.remove('is-hidden');
        }
      });
    });
  });
}

function setupQuickGridToggleParts() {
  const grid = document.getElementById('quickGridParts');
  const toggleBtn = document.getElementById('quickGridToggleParts');
  if (!grid || !toggleBtn) return;

  const extraItems = grid.querySelectorAll('.quick-item-extra');
  if (!extraItems.length) {
    toggleBtn.style.display = 'none';
    return;
  }

  toggleBtn.addEventListener('click', () => {
    const expanded = grid.classList.toggle('is-expanded');
    toggleBtn.textContent = expanded ? 'View Less' : 'View More';
    toggleBtn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
  });
}

function setupRecentProductCards() {
  document.querySelectorAll('.recent-card').forEach(card => {
    const productUrl = card.dataset.productUrl || '';
    card.addEventListener('click', () => {
      if (productUrl) {
        window.location.href = productUrl;
      }
    });
    const addBtn = card.querySelector('.recent-btn');
    if (addBtn) {
      addBtn.addEventListener('click', event => {
        event.stopPropagation();
        if (productUrl) {
          window.location.href = productUrl;
        }
      });
    }
  });
}

function setupQuickPartCards() {
  document.querySelectorAll('#quickGridParts .quick-item').forEach(card => {
    card.addEventListener('click', () => {
      const productUrl = card.dataset.productUrl || '';
      if (productUrl) {
        window.location.href = productUrl;
      }
    });
  });
}

setupConfiguratorPins();
setupQuickGridToggleParts();
setupRecentProductCards();
setupQuickPartCards();
const mobileToggle = document.getElementById('mobileToggle');
const mobilePanel = document.getElementById('mobilePanel');
const mobileClose = document.getElementById('mobileClose');

if (mobileToggle && mobilePanel) {
  mobileToggle.addEventListener('click', () => {
    mobilePanel.classList.add('open');
    document.body.style.overflow = 'hidden';
  });
}
if (mobileClose && mobilePanel) {
  mobileClose.addEventListener('click', () => {
    mobilePanel.classList.remove('open');
    document.body.style.overflow = '';
  });
}

document.querySelectorAll('.mobile-trigger').forEach(trigger => {
  trigger.addEventListener('click', () => {
    const sub = document.getElementById(trigger.dataset.mobile);
    if (!sub) return;
    const isOpen = sub.classList.contains('open');
    document.querySelectorAll('.mobile-sub').forEach(s => s.classList.remove('open'));
    document.querySelectorAll('.mobile-trigger span').forEach(s => s.textContent = '+');
    if (!isOpen) {
      sub.classList.add('open');
      const sig = trigger.querySelector('span');
      if (sig) sig.textContent = '-';
    }
  });
});

function initOfferPopup() {
  const offerButtons = document.querySelectorAll('.nav-pill-offers');
  const overlay = document.getElementById('offerPopupOverlay');
  const timerEl = document.getElementById('offerPopupTimer');
  const codeEl = document.getElementById('offerPopupCode');
  const copyBtn = document.getElementById('offerPopupCopyBtn');
  const applyBtn = document.getElementById('offerPopupApplyBtn');
  if (!offerButtons.length || !overlay || !timerEl || !codeEl || !copyBtn || !applyBtn) return;

  let timerId = null;
  let secondsLeft = 9 * 60 + 59;

  const renderTime = () => {
    const m = Math.floor(secondsLeft / 60);
    const s = secondsLeft % 60;
    timerEl.textContent = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
  };

  const closePopup = () => {
    overlay.classList.remove('open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('offer-popup-open');
    if (timerId) {
      clearInterval(timerId);
      timerId = null;
    }
  };

  const openPopup = () => {
    secondsLeft = 9 * 60 + 59;
    renderTime();
    overlay.classList.add('open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.classList.add('offer-popup-open');
    timerId = setInterval(() => {
      if (secondsLeft <= 0) {
        clearInterval(timerId);
        timerId = null;
        timerEl.textContent = '00:00';
        return;
      }
      secondsLeft -= 1;
      renderTime();
    }, 1000);
  };

  offerButtons.forEach(btn => {
    btn.addEventListener('click', openPopup);
  });

  overlay.querySelectorAll('[data-offer-close]').forEach(el => {
    el.addEventListener('click', closePopup);
  });

  overlay.addEventListener('click', e => {
    if (e.target === overlay) closePopup();
  });

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && overlay.classList.contains('open')) closePopup();
  });

  copyBtn.addEventListener('click', async () => {
    const code = codeEl.textContent.trim();
    try {
      await navigator.clipboard.writeText(code);
      copyBtn.textContent = 'COPIED';
    } catch (_err) {
      copyBtn.textContent = 'COPIED';
    }
    setTimeout(() => { copyBtn.textContent = 'COPY'; }, 1400);
  });

  applyBtn.addEventListener('click', () => {
    applyBtn.textContent = 'APPLIED';
    setTimeout(() => {
      applyBtn.textContent = 'APPLY OFFER';
      closePopup();
    }, 900);
  });
}

initOfferPopup();
@endsection
