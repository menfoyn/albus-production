@extends('layouts.app')

@section('title', 'Portfolyo – Albus Production')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════
   PORTFOLYO HERO  (koyu mor alan — 391px)
═══════════════════════════════════════════════════ */
.pf-hero {
    position: relative;
    width: 100%;
    height: 391px;
    background: #120522;
}
.pf-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 35% 35%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.18) 60%, rgba(0,0,0,0.45) 100%);
    pointer-events: none;
}

/* Devre dışı: nav scrolled arka plan */
.nav.scrolled { background: none !important; backdrop-filter: none !important; }

/* Instagram link — sağ alt */
.pf-instagram {
    position: absolute;
    bottom: 36px;
    right: 125px;
    z-index: 20;
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 0.04em;
    color: rgba(217,217,217,0.7);
    text-decoration: none;
    transition: color 0.2s;
}
.pf-instagram:hover { color: #D9D9D9; }

/* ═══════════════════════════════════════════════════
   TAB FILTERS  (Desktop: yatay ortada, Mobile: yatay scroll)
═══════════════════════════════════════════════════ */
.pf-tabs-section {
    background: #fff;
    width: 100%;
}
.pf-tabs-wrap {
    width: 100%;
    padding: 0 125px;
}
.pf-tabs-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.pf-tabs-scroll::-webkit-scrollbar { display: none; }

.pf-tabs {
    display: flex;
    align-items: center;
    gap: 0;
    padding: 34px 0;
    white-space: nowrap;
    justify-content: center;
}
.pf-tab-item {
    display: flex;
    align-items: center;
}
.pf-tab-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 0.02em;
    color: #BDBDBD;
    transition: color 0.25s;
    padding: 4px 0;
    white-space: nowrap;
    text-decoration: none;
    display: inline-block;
}
.pf-tab-btn:hover { color: #6b6b6b; }
.pf-tab-btn.active { color: #C41027; }
.pf-tab-divider {
    width: 1px;
    height: 28px;
    background: #E6E6E6;
    margin: 0 26px;
    flex-shrink: 0;
}

/* ═══════════════════════════════════════════════════
   DESKTOP GRID  (2 sütun, 578×450 kartlar)
═══════════════════════════════════════════════════ */
.pf-grid-section {
    background: #fff;
    width: 100%;
    padding-bottom: 110px;
}
.pf-grid-wrap {
    width: 100%;
    padding: 0 125px;
}
.pf-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 34px;
}

/* Kart */
.pf-card {
    display: block;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    background: #000;
    aspect-ratio: 578 / 450;
}
.pf-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    display: block;
}
.pf-card:hover img {
    transform: scale(1.03);
}
.pf-card-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #1a1030, #0e0c22);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.08);
    font-size: 56px;
}

/* Kart alt overlay — label + ok birlikte */
.pf-card-bottom {
    position: absolute;
    bottom: 18px;
    left: 22px;
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 3;
    pointer-events: none;
}

/* Sol sütun kartlar (tek sıradaki) — ok solda, sola dönük */
.pf-grid .pf-card:nth-child(odd) .pf-card-bottom {
    flex-direction: row-reverse;
}
.pf-grid .pf-card:nth-child(odd) .pf-card-arrow svg {
    transform: rotate(180deg);
}

/* Sağ sütun kartlar (çift sıradaki) — label + ok sağa hizalı */
.pf-grid .pf-card:nth-child(even) .pf-card-bottom {
    left: auto;
    right: 22px;
}

/* Başlık */
.pf-card-label {
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 24px;
    font-weight: 300;
    letter-spacing: 0.04em;
    color: #fff;
    text-transform: uppercase;
    pointer-events: none;
    line-height: normal;
    white-space: nowrap;
    text-shadow: 0 4px 4px rgba(0,0,0,0.25);
}

/* Ok ikonu */
.pf-card-arrow {
    width: 36px;
    height: 36px;
    border: 1.5px solid rgba(255,255,255,0.7);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    opacity: 0;
    transform: translateX(-6px);
    transition: opacity 0.35s ease, transform 0.35s ease;
    pointer-events: none;
}
.pf-card-arrow svg {
    width: 16px;
    height: 16px;
    stroke: rgba(255,255,255,0.9);
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.pf-card:hover .pf-card-arrow {
    opacity: 1;
    transform: translateX(0);
}

/* Kart alt gradyan */
.pf-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0) 100%);
    pointer-events: none;
    z-index: 1;
}

/* Empty state */
.pf-empty {
    text-align: center;
    padding: 80px 24px;
    color: #999;
    font-family: 'Rubik', 'Inter', sans-serif;
    font-size: 16px;
    background: #fff;
    grid-column: 1 / -1;
}

/* ═══════════════════════════════════════════════════
   MOBILE LAYOUT  (<= 1024px)
   Sol sidebar tab listesi + sağda tek sütun kartlar
═══════════════════════════════════════════════════ */
@media (max-width: 1024px) {
    .pf-hero { height: 320px; }
    .pf-instagram { right: 48px; bottom: 28px; }
    .pf-tabs-wrap { padding: 0 48px; }
    .pf-grid-wrap { padding: 0 48px; }
    .pf-grid-section { padding-bottom: 80px; }
}

@media (max-width: 768px) {
    .pf-hero { height: 260px; }
    .pf-instagram { right: 24px; bottom: 20px; font-size: 13px; }

    /* Tabs section: gizle desktop tabs, sidebar göster */
    .pf-tabs-section { display: none; }

    /* Mobile content layout */
    .pf-grid-section { padding-bottom: 60px; }
    .pf-grid-wrap {
        padding: 0 16px;
        display: flex;
        gap: 0;
        align-items: flex-start;
    }

    /* Sol sidebar (mobile tabs) */
    .pf-mobile-sidebar {
        display: flex;
        flex-direction: column;
        gap: 0;
        width: 90px;
        flex-shrink: 0;
        padding-top: 24px;
        padding-right: 16px;
        position: sticky;
        top: 16px;
    }
    .pf-mobile-tab {
        display: block;
        font-family: 'Rubik', 'Inter', sans-serif;
        font-size: 11px;
        font-weight: 400;
        color: #BDBDBD;
        text-decoration: none;
        padding: 10px 0;
        border-bottom: 1px solid #E6E6E6;
        line-height: 1.35;
        transition: color 0.2s;
    }
    .pf-mobile-tab:first-child { border-top: 1px solid #E6E6E6; }
    .pf-mobile-tab.active { color: #C41027; }
    .pf-mobile-tab:hover { color: #6b6b6b; }

    /* Sağ: kartlar */
    .pf-mobile-cards {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 24px;
        padding-top: 24px;
    }

    /* Desktop grid gizle */
    .pf-grid { display: none; }

    /* Mobile kart */
    .pf-mobile-card {
        display: block;
        text-decoration: none;
        color: #111;
    }
    .pf-mobile-card-img {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #000;
    }
    .pf-mobile-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }
    .pf-mobile-card:hover .pf-mobile-card-img img {
        transform: scale(1.02);
    }
    .pf-mobile-card-img .pf-card-placeholder {
        width: 100%;
        height: 100%;
    }
    .pf-mobile-card-info {
        padding: 12px 0 0;
    }
    .pf-mobile-card-title {
        font-family: 'Rubik', 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 500;
        color: #111;
        margin-bottom: 4px;
    }
    .pf-mobile-card-cat {
        font-family: 'Rubik', 'Inter', sans-serif;
        font-size: 12px;
        font-weight: 300;
        color: #999;
    }
}

/* Gizleme yardımcıları */
.pf-mobile-sidebar { display: none; }
.pf-mobile-cards { display: none; }
@media (max-width: 768px) {
    .pf-mobile-sidebar { display: flex; }
    .pf-mobile-cards { display: flex; }
}
</style>
@endpush

@php
    // Kategori label eşlemesi
    $categoryLabels = [
        'konser'   => 'Konser',
        'toplanti' => 'Toplantı',
        'lansman'  => 'Lansman',
        'fuar'     => 'Fuar',
    ];
@endphp

@section('content')
{{-- ══ HERO ══ --}}
<div class="pf-hero">
    <a href="https://www.instagram.com/albusproduction/"
       target="_blank" rel="noreferrer"
       class="pf-instagram">
        Instagram ↗
    </a>
</div>

{{-- ══ DESKTOP TABS ══ --}}
<section class="pf-tabs-section">
    <div class="pf-tabs-wrap">
        <div class="pf-tabs-scroll">
            <div class="pf-tabs">
                @foreach($tabs as $index => $tab)
                    <div class="pf-tab-item">
                        <a href="{{ route('portfolio', $tab['key'] === 'all' ? [] : ['cat' => $tab['key']]) }}"
                           class="pf-tab-btn {{ $activeCat === $tab['key'] ? 'active' : '' }}">
                            {{ $tab['label'] }}
                        </a>
                        @if($index < count($tabs) - 1)
                            <div class="pf-tab-divider"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ GRID / CARDS ══ --}}
<section class="pf-grid-section">
    <div class="pf-grid-wrap">

        {{-- Mobile sidebar tabs --}}
        <div class="pf-mobile-sidebar">
            @foreach($tabs as $tab)
                <a href="{{ route('portfolio', $tab['key'] === 'all' ? [] : ['cat' => $tab['key']]) }}"
                   class="pf-mobile-tab {{ $activeCat === $tab['key'] ? 'active' : '' }}">
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Desktop 2-column grid --}}
        <div class="pf-grid">
            @if($projects->isEmpty())
                <div class="pf-empty">Henüz proje eklenmemiş.</div>
            @else
                @foreach($projects as $project)
                    <a href="{{ route('portfolio.show', $project->slug) }}" class="pf-card">
                        @if($project->cover_image)
                            <img src="{{ Storage::url($project->cover_image) }}"
                                 alt="{{ $project->title }}"
                                 loading="lazy">
                        @else
                            <div class="pf-card-placeholder">ALBUS</div>
                        @endif
                        <div class="pf-card-bottom">
                            <span class="pf-card-label">{{ $project->title }}</span>
                            <span class="pf-card-arrow">
                                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

        {{-- Mobile single-column cards --}}
        <div class="pf-mobile-cards">
            @if($projects->isEmpty())
                <div class="pf-empty">Henüz proje eklenmemiş.</div>
            @else
                @foreach($projects as $project)
                    <a href="{{ route('portfolio.show', $project->slug) }}" class="pf-mobile-card">
                        <div class="pf-mobile-card-img">
                            @if($project->cover_image)
                                <img src="{{ Storage::url($project->cover_image) }}"
                                     alt="{{ $project->title }}"
                                     loading="lazy">
                            @else
                                <div class="pf-card-placeholder">ALBUS</div>
                            @endif
                        </div>
                        <div class="pf-mobile-card-info">
                            <div class="pf-mobile-card-title">{{ $project->title }}</div>
                            <div class="pf-mobile-card-cat">{{ $categoryLabels[$project->category] ?? $project->category }}</div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

    </div>
</section>
@endsection
