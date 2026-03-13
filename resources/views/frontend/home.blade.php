@extends('layouts.app')

@section('title', 'Albus Production – Etkinlik & Sahne Prodüksiyonu')
@section('description', 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde profesyonel çözümler sunan ekibiz.')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════ */
.hero {
    position: relative;
    height: 100vh;
    min-height: 600px;
    background: #000;
    overflow: hidden;
}
.hero-slides { position: absolute; inset: 0; }
.hero-slide {
    position: absolute; inset: 0;
    opacity: 0;
    transition: opacity 1.2s ease;
}
.hero-slide.active { opacity: 1; }
.hero-slide img,
.hero-slide video {
    width: 100%; height: 100%;
    object-fit: cover;
    opacity: 0.7;
}
/* Alt koyulaştırma gradyanı */
.hero-vignette {
    position: absolute; inset: 0; z-index: 2;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.05) 0%,
        rgba(0,0,0,0) 50%,
        rgba(0,0,0,0.45) 85%,
        rgba(0,0,0,0.75) 100%
    );
}

/* ── Hero alt info bar (Biz Kimiz / metin / Instagram) ── */
.hero-bar {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    z-index: 10;
    display: flex;
    align-items: center;
    background: #120522;
    border-top: none;
    padding: 0 80px 0 83px;
    height: 130px;
    gap: 0;
}
.hero-bar-cell {
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex-shrink: 0;
}
.hero-bar-cell:first-child {
    width: 122px;
}
.hero-bar-cell:nth-child(3) {
    flex: 0 0 auto;
    width: 560px;
    padding-left: 41px;
}
.hero-bar-spacer {
    flex: 1;
}
.hero-bar-cell:last-child {
    flex-shrink: 0;
}
.hero-bar-divider {
    width: 1px;
    height: 40px;
    background: rgba(217,217,217,0.2);
    flex-shrink: 0;
}
.hero-bar-label {
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 300;
    color: #D9D9D9;
    margin-bottom: 0;
    white-space: nowrap;
}
.hero-bar-desc {
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 300;
    color: #D9D9D9;
    line-height: 1.3;
    letter-spacing: 0;
}
.hero-bar-instagram {
    display: flex;
    align-items: center;
    gap: 6px;
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: rgba(217,217,217,0.9);
    text-decoration: none;
    transition: color 0.2s;
    white-space: nowrap;
    opacity: 0.9;
}
.hero-bar-instagram:hover { color: #fff; opacity: 1; }
.hero-bar-instagram .ext { font-size: 12px; }

/* Slider dots (üst sağ köşe) */
.hero-dots {
    position: absolute;
    top: 36px; right: 36px;
    z-index: 10;
    display: flex; gap: 8px;
}
.hero-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    border: none; cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}
.hero-dot.active { background: #fff; transform: scale(1.25); }

/* ═══════════════════════════════════════════════════
   SON İŞLERİMİZ  —  DECK STACK (scroll-driven)
═══════════════════════════════════════════════════ */
.section-projects {
    background: #fff;
    position: relative;
}

/* Scroll alanı — JS ile yükseklik hesaplanacak */
.projects-scroll-range {
    position: relative;
}

.projects-layout {
    display: flex;
    align-items: flex-start;
    gap: 0;
    padding: 0 125px;
    height: 100%;
}

/* Sol: sticky viewport — kartlar burada üst üste biner */
.projects-deck-area {
    flex: 1;
    min-width: 0;
    position: sticky;
    top: 0;
    height: 100vh;
}

/* Kart konteyneri — kartlar absolute olarak üst üste */
.projects-deck-stage {
    position: relative;
    width: 100%;
    height: 100%;
}

/* Her kart absolute, JS ile translateY kontrol edilir */
.project-card-deck {
    position: absolute;
    left: 0;
    width: 100%;
    max-width: 1100px;
    will-change: transform;
    filter: drop-shadow(0 30px 60px rgba(0,0,0,0.18));
}

.project-card {
    display: grid;
    grid-template-columns: 68% 48%;
    border-radius: 20px;
    overflow: hidden;
    height: 565px;
    text-decoration: none;
    color: #fff;
    position: relative;
}

.project-card.red-card  { background: #C41027; }
.project-card.blue-card { background: #1910C4; }
.project-card.dark-card { background: #BB2A06; }

/* Resim alanı — Figma: 601×462, radius 21, kart içinde ortalı */
.project-card-img {
    position: relative;
    overflow: hidden;
    border-radius: 21px;
    margin: 52px 16px 52px 54px;
}
.project-card-img img {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.project-card:hover .project-card-img img { transform: scale(1.04); }
.project-card-img-empty {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0.2);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.15); font-size: 56px;
}

/* Sağ taraf: başlık üstte, açıklama ortada, ok altta */
.project-card-body {
    padding: 52px 36px 52px 48px;
    display: flex; flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.project-card-header {
    margin-bottom: 0;
}
.project-card-cat {
    font-family: 'Rubik', sans-serif;
    font-size: 20px; font-weight: 400;
    letter-spacing: 0;
    opacity: 0.7; margin-bottom: 0; margin-top: 6px;
    text-transform: none;
}
.project-card-title {
    font-family: 'Rubik', sans-serif;
    font-size: 40px;
    font-weight: 700;
    letter-spacing: -0.5px;
    line-height: 1.1;
    margin-bottom: 0;
}
.project-card-desc {
    font-family: 'Rubik', sans-serif;
    font-size: 20px; font-weight: 400; opacity: 1; line-height: 1.19;
    white-space: pre-line;
    margin: 0;
}
.project-card-arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 46px; height: 46px;
    border-radius: 50%;
    border: 1.33px solid rgba(255,255,255,1);
    transition: background 0.25s, border-color 0.25s;
    color: #fff;
    margin-top: 0;
    align-self: flex-start;
}
.project-card:hover .project-card-arrow {
    background: rgba(255,255,255,0.15);
    border-color: rgba(255,255,255,0.6);
}

/* ── Sticky Sidebar (sağ) ── */
.projects-sidebar {
    width: 200px;
    flex-shrink: 0;
    padding-left: 40px;
    padding-top: calc((100vh - 565px) / 2);
    box-sizing: border-box;
    position: sticky;
    top: 0;
    height: 100vh;
}
.projects-sidebar-inner {
    position: relative;
}
.sidebar-title-block {
    position: relative;
    padding-left: 44px;
    margin-left: 45px; /* ← bunu değiştirerek sadece "Son İşlerimiz" + çizgiyi sağa/sola taşı */
    height: 168px;
    display: flex;
    align-items: center;
}
.sidebar-title-block::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 3px;
    height: 168px;
    background: #C41027;
}
.projects-sidebar h2 {
    font-family: 'Rubik', sans-serif;
    font-size: 32px;
    font-weight: 400;
    color: #C41027;
    letter-spacing: 0;
    line-height: 1.12;
    margin-top: 0;
    margin-bottom: 0;
}
.projects-sidebar .view-all {
    font-family: 'Rubik', sans-serif;
    font-size: 16px;
    color: #C41027;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 21px;
    font-weight: 400;
    margin-left: 45px; /* ← sağa/sola kaydırmak için değiştir */
    margin-top: 138px;
    transition: gap 0.2s;
}
.projects-sidebar .view-all:hover { gap: 28px; }

/* ═══════════════════════════════════════════════════
   HİZMETLERİMİZ — FIGMA CAROUSEL
═══════════════════════════════════════════════════ */
.section-services {
    padding: 80px 0 120px;
    background: #fff;
    border-top: 1px solid #ebebeb;
    overflow: hidden;
}

/* Header */
.srv-header {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
    padding: 0 125px;
}
.srv-header-link-mobile { display: none; }
.srv-header-left {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 22px;
}
.srv-header-line {
    width: 2px;
    height: 165px;
    background: var(--red);
    flex-shrink: 0;
}
.srv-header-title {
    font-size: 40px;
    font-weight: 400;
    color: var(--red);
    line-height: 1;
    letter-spacing: 0;
}
.srv-header-link {
    font-size: clamp(16px, 1.4vw, 20px);
    font-weight: 400;
    color: var(--red);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    letter-spacing: 0.06em;
    transition: gap 0.25s;
}
.srv-header-link:hover { gap: 18px; }

/* Content row */
.srv-content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
    padding: 48px 125px 0;
}
@media (min-width: 1025px) {
    .srv-content {
        grid-template-columns: 270px 1fr;
        gap: 80px;
        padding: 90px 125px 0;
        align-items: start;
    }
}

/* Left text panel */
.srv-text {
    display: flex;
    gap: 22px;
}
@media (min-width: 1025px) {
    .srv-text { margin-top: 120px; }
}
.srv-text-line {
    margin-top: 6px;
    width: 2px;
    height: 127px;
    background: #442D84;
    flex-shrink: 0;
    border-radius: 0;
}
.srv-text-title {
    font-size: 24px;
    font-weight: 400;
    color: #442D84;
    line-height: normal;
    letter-spacing: 0;
    margin-bottom: 18px;
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.srv-text-desc {
    font-size: 20px;
    font-weight: 300;
    color: #442D84;
    line-height: normal;
    letter-spacing: 0.04em;
    max-width: 280px;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Controls */
.srv-text-body {
    min-height: 460px;
}
.srv-controls {
    display: flex;
    gap: 12px;
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: 5;
}
.srv-controls button {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 1.33px solid rgba(0,0,0,0.35);
    background: transparent;
    color: rgba(0,0,0,0.6);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s;
}
.srv-controls button:hover {
    border-color: rgba(0,0,0,0.7);
    color: rgba(0,0,0,0.9);
}

/* Right column wrapper */
.srv-right-col {
    position: relative;
}
.srv-right-top {
    position: absolute;
    top: 0px;
    right: -35px;
}
.srv-right-col .srv-controls {
    bottom: 10px;
    left: -120px;
}

/* Mobile title row (title + controls side by side) */
.srv-title-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
}
.srv-controls-mobile { display: none; }

/* Right gallery / carousel stage */
.srv-stage {
    position: relative;
    height: 420px;
    overflow: visible;
}
@media (min-width: 1025px) {
    .srv-stage { height: 560px; }
}

.srv-card {
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 0;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 34px 100px rgba(0,0,0,0.18);
    transition: left 0.55s cubic-bezier(0.25,0.46,0.45,0.94),
                width 0.55s cubic-bezier(0.25,0.46,0.45,0.94),
                height 0.55s cubic-bezier(0.25,0.46,0.45,0.94),
                top 0.55s cubic-bezier(0.25,0.46,0.45,0.94),
                opacity 0.55s ease;
    will-change: left, width, height, top, opacity;
}
.srv-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    pointer-events: none;
}
.srv-card-no-img {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #ddd, #eee);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #bbb;
    font-size: 48px;
}

/* ─── Responsive ─── */
@media (max-width: 1024px) {
    .projects-sidebar { display: none; }
    .projects-layout { padding: 0 48px; }
    .project-card-deck { max-width: 100%; }
}
@media (max-width: 768px) {
    .hero-bar { flex-direction: column; padding: 24px 20px; height: auto; gap: 12px; }
    .hero-bar-divider { display: none; }
    .hero-bar-cell:first-child,
    .hero-bar-cell:nth-child(3) { width: 100%; max-width: 100%; }
    .hero-bar-spacer { display: none; }
    .projects-layout { padding: 0 20px; }
    .project-card { grid-template-columns: 1fr; height: auto; }
    .project-card-img { height: 280px; margin: 20px 20px 0; }
    .project-card-body { padding: 24px 24px 24px; }

    /* Services — mobile layout */
    .srv-header { padding: 0 20px; align-items: center; }
    .srv-header-link-mobile { display: inline-flex; }
    .srv-content { display: flex; flex-direction: column; padding: 24px 20px 0; gap: 24px; }
    .srv-right-col { order: -1; }
    .srv-right-top { display: none; }
    .srv-right-col > .srv-controls { display: none; }
    .srv-controls-mobile { display: flex; flex-shrink: 0; }
    .srv-stage { height: 280px; }
    .srv-text-body { min-height: unset; }
    .srv-text-desc { max-width: 100%; }
    .srv-text { gap: 16px; }
}
</style>
@endpush

@section('content')

@php
    $categoryLabels = [
        'konser'   => 'Konser & Festival & Tiyatro',
        'toplanti' => 'Toplantı & Konferans',
        'lansman'  => 'Lansman & Gala & Sergi',
        'fuar'     => 'Fuar & Stand Uygulamaları',
    ];
@endphp

{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-slides">
        @forelse($heroSlides as $index => $slide)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                @if($slide->type === 'video')
                    <video autoplay muted loop playsinline>
                        <source src="{{ Storage::url($slide->file_path) }}" type="video/mp4">
                    </video>
                @else
                    <img src="{{ Storage::url($slide->file_path) }}"
                         alt="{{ $slide->alt_text ?? 'Albus Production' }}"
                         loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                @endif
            </div>
        @empty
            {{-- Placeholder --}}
            <div class="hero-slide active" style="background:linear-gradient(135deg,#07061a 0%,#110a2a 50%,#060f1c 100%);">
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                    <span style="font-size:clamp(80px,15vw,200px);font-weight:800;letter-spacing:-6px;color:rgba(255,255,255,0.035);">ALBUS</span>
                </div>
            </div>
        @endforelse
    </div>
    <div class="hero-vignette"></div>

    {{-- Slider dots --}}
    @if($heroSlides->count() > 1)
    <div class="hero-dots" id="heroDots">
        @foreach($heroSlides as $index => $slide)
            <button class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></button>
        @endforeach
    </div>
    @endif

    {{-- Alt bilgi barı --}}
    <div class="hero-bar">
        <div class="hero-bar-cell">
            <span class="hero-bar-label">Biz Kimiz?</span>
        </div>
        <div class="hero-bar-divider"></div>
        <div class="hero-bar-cell">
            <span class="hero-bar-desc">
                Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel bir ekibiz.
            </span>
        </div>
        <div class="hero-bar-spacer"></div>
        <div class="hero-bar-cell">
            <a href="https://www.instagram.com/albusproduction" target="_blank" rel="noopener" class="hero-bar-instagram">
                Instagram <span class="ext">↗</span>
            </a>
        </div>
    </div>
</section>

{{-- ══ SON İŞLERİMİZ — DECK STACK ══ --}}
<section class="section-projects">
    <div class="projects-scroll-range" id="projectsRange">
        <div class="projects-layout">

            {{-- Sol: sticky deck area --}}
            <div class="projects-deck-area">
                <div class="projects-deck-stage" id="projectsDeck">
                    @php $cardColors = ['red-card','blue-card','dark-card']; @endphp

                    @forelse($featuredProjects as $index => $project)
                    <div class="project-card-deck" data-deck-index="{{ $index }}" style="z-index: {{ 300 + $index }};">
                        <a href="{{ route('portfolio.show', $project->slug) }}"
                           class="project-card {{ $cardColors[$index % 3] }}">
                            <div class="project-card-img">
                                @if($project->cover_image)
                                    <img src="{{ Storage::url($project->cover_image) }}"
                                         alt="{{ $project->title }}" loading="lazy">
                                @else
                                    <div class="project-card-img-empty">🎬</div>
                                @endif
                            </div>
                            <div class="project-card-body">
                                <div class="project-card-header">
                                    <h3 class="project-card-title">{!! nl2br(e($project->title)) !!}</h3>
                                    @if($project->short_label || $project->category)
                                    <p class="project-card-cat">{{ $project->short_label ?: ($categoryLabels[$project->category] ?? $project->category) }}</p>
                                    @endif
                                </div>
                                @if($project->short_description)
                                <p class="project-card-desc">{{ $project->short_description }}</p>
                                @endif
                                <span class="project-card-arrow">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            </div>
                        </a>
                    </div>
                    @empty
                    <p style="color:#999;padding:40px 0;">Henüz proje eklenmemiş.</p>
                    @endforelse
                </div>
            </div>

            {{-- Sağ: sticky başlık --}}
            <div class="projects-sidebar">
                <div class="projects-sidebar-inner">
                    <div class="sidebar-title-block">
                        <h2>Son<br>İşlerimiz</h2>
                    </div>
                    <a href="{{ route('portfolio') }}" class="view-all">Tüm İşler →</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══ HİZMETLERİMİZ — FIGMA CAROUSEL ══ --}}
@if($services->isNotEmpty())
<section class="section-services">
    {{-- Header --}}
    <div class="srv-header">
        <div class="srv-header-left">
            <div class="srv-header-line"></div>
            <h2 class="srv-header-title">Hizmetlerimiz</h2>
        </div>
        {{-- Mobilde header'da göster --}}
        <a href="{{ route('services') }}" class="srv-header-link srv-header-link-mobile">
            Tüm Hizmetler <span aria-hidden>→</span>
        </a>
    </div>

    {{-- Content: text left + carousel right --}}
    <div class="srv-content">
        {{-- Left panel --}}
        <div class="srv-text">
            <div class="srv-text-line"></div>
            <div class="srv-text-body">
                <div class="srv-title-row">
                    <h3 class="srv-text-title" id="srvTitle">{{ $services->first()->title }}</h3>
                    {{-- Mobil oklar --}}
                    <div class="srv-controls srv-controls-mobile">
                        <button type="button" id="srvPrevMobile" aria-label="Önceki">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        </button>
                        <button type="button" id="srvNextMobile" aria-label="Sonraki">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                </div>
                <p class="srv-text-desc" id="srvDesc">{{ $services->first()->short_description }}</p>
            </div>
        </div>

        {{-- Right: link + carousel stage --}}
        <div class="srv-right-col">
            <div class="srv-right-top">
                <a href="{{ route('services') }}" class="srv-header-link">
                    Tüm Hizmetler <span aria-hidden>→</span>
                </a>
            </div>
            <div class="srv-controls">
                <button type="button" id="srvPrev" aria-label="Önceki">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                </button>
                <button type="button" id="srvNext" aria-label="Sonraki">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
            </div>
            <div class="srv-stage" id="srvStage">
                @foreach($services as $index => $service)
                <div class="srv-card" data-srv-index="{{ $index }}">
                    @if($service->cover_image)
                        <img src="{{ Storage::url($service->cover_image) }}" alt="{{ $service->title }}" loading="lazy">
                    @else
                        <div class="srv-card-no-img">🎭</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
/* ── Hero Slider ── */
(function(){
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    if (!slides.length) return;
    let cur = 0, t;
    function goTo(n){
        slides[cur].classList.remove('active');
        dots[cur]?.classList.remove('active');
        cur = (n + slides.length) % slides.length;
        slides[cur].classList.add('active');
        dots[cur]?.classList.add('active');
    }
    dots.forEach(d => d.addEventListener('click', ()=>{ clearInterval(t); goTo(+d.dataset.index); t=setInterval(()=>goTo(cur+1),6000); }));
    if(slides.length > 1) t = setInterval(()=>goTo(cur+1), 6000);
})();

/* ── Projects Deck Stack (scroll-driven) ── */
(function(){
    const range = document.getElementById('projectsRange');
    const deck  = document.getElementById('projectsDeck');
    const cards = document.querySelectorAll('.project-card-deck');
    if (!range || !deck || !cards.length) return;

    const CARD_H = 565;
    const HOLD   = 0.22;
    const steps  = Math.max(cards.length - 1, 1);

    let vh = window.innerHeight;

    const initStageTop = Math.round((vh - CARD_H) / 2);
    range.style.height = ((cards.length + 1) * vh) + 'px';
    cards.forEach(c => { c.style.top = initStageTop + 'px'; });

    function clamp(n, min, max) { return Math.max(min, Math.min(max, n)); }

    function onScroll() {
        const rect = range.getBoundingClientRect();
        // Bölüm tamamen görünüm dışındaysa işlem yapma
        if (rect.bottom < 0 || rect.top > vh) return;

        const scrollStart = -rect.top;
        const scrollEnd   = range.offsetHeight - vh;
        if (scrollEnd <= 0) return;

        const rawProgress  = clamp(scrollStart / scrollEnd, 0, 1);
        const deckProgress = clamp(rawProgress / (1 - HOLD), 0, 1);

        cards.forEach((cardEl, i) => {
            if (i === 0) {
                cardEl.style.transform = 'translateY(0)';
                return;
            }

            const segStart = (i - 1) / steps;
            const segEnd   = i / steps;

            let y;
            if (deckProgress <= segStart) {
                y = vh;
            } else if (deckProgress >= segEnd) {
                y = 0;
            } else {
                const t    = (deckProgress - segStart) / (segEnd - segStart);
                const ease = 1 - Math.pow(1 - t, 3);
                y = vh * (1 - ease);
            }

            cardEl.style.transform = `translateY(${y}px)`;
        });
    }

    function onResize() {
        vh = window.innerHeight;
        const newStageTop = Math.round((vh - CARD_H) / 2);
        cards.forEach(c => { c.style.top = newStageTop + 'px'; });
        range.style.height = ((cards.length + 1) * vh) + 'px';
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onResize, { passive: true });
    onScroll();
})();

/* ── Services Figma Carousel ── */
(function(){
    const stage = document.getElementById('srvStage');
    const titleEl = document.getElementById('srvTitle');
    const descEl  = document.getElementById('srvDesc');
    if (!stage) return;

    const cards = Array.from(stage.querySelectorAll('.srv-card'));
    const N = cards.length;
    if (!N) return;

    const srvData = [];
    @if(isset($services))
    @foreach($services as $s)
    srvData.push({ title: @json($s->title), desc: @json($s->short_description ?? '') });
    @endforeach
    @endif

    let active = 0;
    let animating = false;
    const mod = (n, m) => ((n % m) + m) % m;

    function getPositions() {
        const stageW = stage.offsetWidth;
        const stageH = stage.offsetHeight;
        const isDesktop = window.innerWidth >= 1025;

        const BASE_W  = isDesktop ? Math.min(stageW * 200, 490) : stageW * 0.65;
        const BASE_H  = stageH;
        const SMALL_W = isDesktop ? Math.min(stageW * 0.34, 328) : stageW * 0.45;
        const SMALL_H = stageH * 0.72;
        const GAP     = isDesktop ? 28 : 16;
        const SMALL_Y = BASE_H - SMALL_H;

        return {
            // slot -1: off-screen left (for incoming prev)
            '-1': { left: -(SMALL_W + GAP), width: SMALL_W, height: SMALL_H, top: SMALL_Y, z: 5, opacity: 0 },
            // slot 0: big active card
            '0':  { left: 0,                width: BASE_W,  height: BASE_H,  top: 0,       z: 30, opacity: 1 },
            // slot 1: first small
            '1':  { left: BASE_W + GAP,     width: SMALL_W, height: SMALL_H, top: SMALL_Y, z: 20, opacity: 1 },
            // slot 2: second small
            '2':  { left: BASE_W + GAP + SMALL_W + GAP, width: SMALL_W, height: SMALL_H, top: SMALL_Y, z: 10, opacity: 1 },
            // slot 3: off-screen right (for outgoing)
            '3':  { left: stageW + GAP,     width: SMALL_W, height: SMALL_H, top: SMALL_Y, z: 5, opacity: 0 },
        };
    }

    function applyPos(card, pos) {
        card.style.left    = pos.left + 'px';
        card.style.width   = pos.width + 'px';
        card.style.height  = pos.height + 'px';
        card.style.top     = pos.top + 'px';
        card.style.zIndex  = pos.z;
        card.style.opacity = pos.opacity;
    }

    // Which slot each card-index is currently in (by active)
    function slotOf(cardIndex) {
        const diff = mod(cardIndex - active, N);
        if (diff === 0) return 0;
        if (diff === 1) return 1;
        if (diff === 2) return 2;
        if (diff === N - 1) return -1;
        return 3; // everything else off-screen right
    }

    function layout(animate) {
        const positions = getPositions();

        cards.forEach((card, i) => {
            const slot = slotOf(i);
            const pos = positions[String(slot)] || positions['3'];

            if (!animate) {
                // Instant position (no transition)
                card.style.transition = 'none';
                applyPos(card, pos);
                // Force reflow then restore transition
                card.offsetHeight;
                card.style.transition = '';
            } else {
                applyPos(card, pos);
            }
        });

        // Text is updated separately with animation in goNext/goPrev
    }

    function animateTextOut(dir) {
        const offset = dir === 'next' ? '-18px' : '18px';
        if (titleEl) { titleEl.style.opacity = '0'; titleEl.style.transform = 'translateY(' + offset + ')'; }
        if (descEl)  { descEl.style.opacity  = '0'; descEl.style.transform  = 'translateY(' + offset + ')'; }
    }

    function animateTextIn(dir) {
        const fromOffset = dir === 'next' ? '18px' : '-18px';
        if (titleEl) { titleEl.style.transition = 'none'; titleEl.style.opacity = '0'; titleEl.style.transform = 'translateY(' + fromOffset + ')'; }
        if (descEl)  { descEl.style.transition  = 'none'; descEl.style.opacity  = '0'; descEl.style.transform  = 'translateY(' + fromOffset + ')'; }
        // force reflow
        titleEl && titleEl.offsetHeight;
        if (titleEl) titleEl.style.transition = '';
        if (descEl)  descEl.style.transition  = '';
        requestAnimationFrame(() => {
            if (titleEl) { titleEl.style.opacity = '1'; titleEl.style.transform = 'translateY(0)'; }
            if (descEl)  { descEl.style.opacity  = '1'; descEl.style.transform  = 'translateY(0)'; }
        });
    }

    function goNext() {
        if (animating || N <= 1) return;
        animating = true;

        animateTextOut('next');

        const positions = getPositions();
        active = mod(active + 1, N);

        const newSlot2Idx = mod(active + 2, N);
        const newSlot2Card = cards[newSlot2Idx];
        newSlot2Card.style.transition = 'none';
        applyPos(newSlot2Card, positions['3']);
        newSlot2Card.offsetHeight;
        newSlot2Card.style.transition = '';

        layout(true);

        setTimeout(() => {
            if (titleEl) titleEl.textContent = srvData[active]?.title || '';
            if (descEl)  descEl.textContent  = srvData[active]?.desc  || '';
            animateTextIn('next');
            animating = false;
        }, 320);
    }

    function goPrev() {
        if (animating || N <= 1) return;
        animating = true;

        animateTextOut('prev');

        const positions = getPositions();
        active = mod(active - 1, N);

        const newActiveCard = cards[active];
        newActiveCard.style.transition = 'none';
        applyPos(newActiveCard, positions['-1']);
        newActiveCard.offsetHeight;
        newActiveCard.style.transition = '';

        layout(true);

        setTimeout(() => {
            if (titleEl) titleEl.textContent = srvData[active]?.title || '';
            if (descEl)  descEl.textContent  = srvData[active]?.desc  || '';
            animateTextIn('prev');
            animating = false;
        }, 320);
    }

    document.getElementById('srvNext')?.addEventListener('click', goNext);
    document.getElementById('srvPrev')?.addEventListener('click', goPrev);
    document.getElementById('srvNextMobile')?.addEventListener('click', goNext);
    document.getElementById('srvPrevMobile')?.addEventListener('click', goPrev);

    // Touch/drag
    let startX = 0, dragging = false;
    stage.addEventListener('pointerdown', e => { startX = e.clientX; dragging = true; });
    stage.addEventListener('pointerup', e => {
        if (!dragging) return;
        dragging = false;
        const dx = e.clientX - startX;
        if (dx < -60) goNext();
        else if (dx > 60) goPrev();
    });

    window.addEventListener('resize', () => layout(false), { passive: true });
    layout(false);
})();
</script>
@endpush
