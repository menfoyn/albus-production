@extends('layouts.app')
@section('title', 'Hizmetlerimiz – Albus Production')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════
   HİZMETLERİMİZ HERO (Figma: 1440×391, #120522)
═══════════════════════════════════════════════════ */
.services-hero {
    position: relative;
    width: 100%;
    height: 391px;
    background: #120522;
}
.services-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 35% 35%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.18) 60%, rgba(0,0,0,0.45) 100%);
    pointer-events: none;
}

/* Layout'taki hamburger bu sayfada da aynı yerde görünecek */
/* Nav scrolled durumunu bu sayfada devre dışı bırak */
.nav.scrolled {
    background: none !important;
    backdrop-filter: none !important;
}

/* ── Instagram link — sağ alt ── */
.services-instagram {
    position: absolute;
    bottom: 36px;
    right: 123px;
    z-index: 20;
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 0.04em;
    color: rgba(217,217,217,0.7);
    text-decoration: none;
    transition: color 0.2s;
}
.services-instagram:hover { color: #D9D9D9; }

/* ═══════════════════════════════════════════════════
   HİZMETLERİMİZ BAŞLIK (Rubik 600 48px #C41027)
═══════════════════════════════════════════════════ */
.services-title-section {
    background: #fff;
    padding: 64px 0 48px;
}
.services-title-wrap {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 48px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
}
@media (min-width: 1025px) {
    .services-title-wrap { padding: 0 123px; }
}
.services-title-line {
    width: 3px;
    height: 60px;
    background: #C41027;
    flex-shrink: 0;
    border-radius: 1px;
    margin-top: 4px;
}
.services-title-wrap h1 {
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 48px;
    font-weight: 600;
    color: #C41027;
    line-height: 1;
    letter-spacing: 0;
    text-transform: uppercase;
}

/* ═══════════════════════════════════════════════════
   SERVICE BLOCK
═══════════════════════════════════════════════════ */
.service-block {
    background: #fff;
}
.service-block-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 48px;
}
@media (min-width: 1025px) {
    .service-block-inner { padding: 0 123px; }
}

/* Image — ortada, max 780px */
.service-block-image {
    padding-top: 16px;
    max-width: 780px;
    margin: 0 auto;
}
.service-block-image-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: #0a0a0a;
}
.service-block-image-wrap img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.service-block-no-img {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #1a1030, #0e0c22);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.08);
    font-size: 56px;
}

/* Text grid — ortada, max 780px */
.service-block-text {
    display: grid;
    grid-template-columns: 1fr;
    gap: 28px;
    padding: 40px 0 64px;
    max-width: 780px;
    margin: 0 auto;
}
@media (min-width: 768px) {
    .service-block-text {
        grid-template-columns: 1fr 1fr;
        gap: 70px;
    }
}

/* Left column */
.service-block-left {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.service-block-line {
    margin-top: 4px;
    width: 2px;
    align-self: stretch;
    background: #C41027;
    flex-shrink: 0;
    border-radius: 1px;
}
.service-block-title {
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: #C41027;
    margin-bottom: 14px;
}
.service-block-desc {
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.55;
    color: #442D84;
}

/* Right column */
.service-block-right h4 {
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #442D84;
    margin-bottom: 12px;
}
.service-block-bullets {
    list-style: none;
    padding: 0;
}
.service-block-bullets li {
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.55;
    color: #442D84;
    margin-bottom: 6px;
}
.service-block-bullets li::before {
    content: '•';
    margin-right: 8px;
}

/* Empty state */
.services-empty {
    text-align: center;
    padding: 80px 24px;
    color: #999;
    font-size: 16px;
    background: #fff;
}

/* ─── Responsive ─── */
@media (max-width: 1024px) {
    .services-instagram { right: 48px; bottom: 28px; }
}
@media (max-width: 768px) {
    .services-hero { height: 280px; }
    .services-instagram { right: 24px; bottom: 20px; font-size: 13px; }
    .services-title-section { padding: 40px 0 32px; }
    .services-title-wrap { padding: 0 24px; }
    .services-title-wrap h1 { font-size: 32px; }
    .services-title-line { height: 40px; }
    .service-block-inner { padding: 0 24px; }
    .service-block-image { padding-top: 8px; }
    .service-block-text { padding: 28px 0 48px; }
}
</style>
@endpush

@section('content')
{{-- ══ HERO (koyu mor alan — nav/hamburger layout'tan geliyor) ══ --}}
<div class="services-hero">
    {{-- Instagram --}}
    <a href="https://www.instagram.com/albusproduction/"
       target="_blank" rel="noreferrer"
       class="services-instagram">
        Instagram ↗
    </a>
</div>

{{-- ══ HİZMETLERİMİZ BAŞLIK ══ --}}
<div class="services-title-section">
    <div class="services-title-wrap">
        <div class="services-title-line"></div>
        <h1>HİZMETLERİMİZ</h1>
    </div>
</div>

{{-- ══ SERVICE BLOCKS ══ --}}
@if($serviceItems->isEmpty())
    <div class="services-empty">Henüz hizmet eklenmemiş.</div>
@else
    @foreach($serviceItems as $item)
    <section class="service-block">
        <div class="service-block-inner">
            {{-- Image --}}
            <div class="service-block-image">
                <div class="service-block-image-wrap">
                    @if($item->image)
                        <img src="{{ Storage::url($item->image) }}"
                             alt="{{ $item->title }}"
                             loading="lazy">
                    @else
                        <div class="service-block-no-img">ALBUS</div>
                    @endif
                </div>
            </div>

            {{-- Text: 2 columns --}}
            <div class="service-block-text">
                {{-- Sol: başlık + açıklama --}}
                <div class="service-block-left">
                    <div class="service-block-line"></div>
                    <div>
                        <h3 class="service-block-title">{{ $item->title }}</h3>
                        @if($item->description)
                            <p class="service-block-desc">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>

                {{-- Sağ: hizmet kapsamı maddeleri --}}
                @if($item->bullets && count($item->bullets) > 0)
                <div class="service-block-right">
                    <h4>Hizmet Kapsamı:</h4>
                    <ul class="service-block-bullets">
                        @foreach($item->bullets as $bullet)
                            <li>{{ $bullet }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endforeach
@endif
@endsection
