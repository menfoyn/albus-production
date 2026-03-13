@extends('layouts.app')
@section('title', 'Biz Kimiz – Albus Production')
@section('description', 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde profesyonel çözümler sunan ekibiz.')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════
   BİZ KİMİZ — HERO SPACER
═══════════════════════════════════════════════════ */
.about-hero-spacer {
    height: 200px;
    background: #0e0c22;
}
@media (min-width: 1025px) {
    .about-hero-spacer { height: 280px; }
}

/* ── Nav hamburger düzeltme: about sayfasında hero spacer içinde kalsın ── */
.nav-hamburger {
    top: 220px !important;
}
@media (max-width: 1024px) {
    .nav-hamburger { top: 150px !important; }
}
@media (max-width: 768px) {
    .nav-hamburger { top: 100px !important; }
}

/* ═══════════════════════════════════════════════════
   BİZ KİMİZ — ABOUT INTRO
═══════════════════════════════════════════════════ */
.section-about-intro {
    background: #fff;
    padding: 56px 24px 0;
    overflow: hidden;
}
@media (min-width: 768px) {
    .section-about-intro { padding: 72px 40px 0; }
}
@media (min-width: 1025px) {
    .section-about-intro { padding: 90px 83px 0; }
}
.about-intro-inner {
    max-width: 1440px;
    margin: 0 auto;
}

/* Üst: sol (kırmızı çizgi + başlık + açıklama) | sağ (iletişim) */
.about-top {
    display: flex;
    flex-direction: column;
    gap: 40px;
}
@media (min-width: 1025px) {
    .about-top {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        column-gap: 24px;
        align-items: flex-start;
    }
}

.about-top-left {
    display: flex;
    align-items: flex-start;
    gap: 38px;
}
@media (min-width: 1025px) {
    .about-top-left { grid-column: 1 / 6; }
}
.about-red-line {
    width: 2px;
    flex-shrink: 0;
    background: #C41027;
    height: 80px;
    margin-top: 6px;
}
@media (min-width: 1025px) {
    .about-red-line { height: 165px; margin-top: 10px; }
}
.about-title {
    font-family: 'Rubik', sans-serif;
    font-size: 32px;
    font-weight: 600;
    line-height: 1.1;
    color: #C41027;
}
@media (min-width: 1025px) {
    .about-title { font-size: 48px; line-height: 1; }
}
.about-desc {
    margin-top: 24px;
    font-family: 'Rubik', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.3;
    color: #4C358C;
    max-width: 453px;
}
@media (min-width: 1025px) {
    .about-desc { font-size: 24px; line-height: 1.3; }
}

/* Sağ: iletişim */
.about-top-right {
    font-family: 'Rubik', sans-serif;
    font-size: 16px;
    color: #3B2577;
}
@media (min-width: 1025px) {
    .about-top-right {
        grid-column: 9 / 13;
        text-align: right;
        padding-top: 12px;
    }
}
.about-contact-address {
    font-size: 16px;
    font-weight: 400;
    line-height: 1.52;
    margin-bottom: 18px;
    white-space: pre-line;
    letter-spacing: 0.06em;
}
.about-contact-link {
    display: block;
    color: #3B2577;
    text-decoration: underline;
    transition: color 0.2s;
    margin-bottom: 8px;
    font-weight: 400;
    font-size: 18px;
    line-height: 1.3;
    letter-spacing: 0.06em;
}
.about-contact-link:hover { color: #C41027; }

/* Görsel */
.about-image-wrap {
    margin-top: 60px;
    display: flex;
    justify-content: center;
    padding-bottom: 0;
    overflow: hidden;
}
@media (min-width: 1025px) {
    .about-image-wrap {
        margin-top: 80px;
        padding-bottom: 0;
    }
}
.about-image-wrap img {
    width: 100%;
    max-width: 100%;
    height: auto;
    min-height: 220px;
    max-height: 500px;
    object-fit: cover;
    display: block;
    transform: scale(0.55);
    transition: transform 0.1s ease-out;
    will-change: transform;
    border-radius: 8px;
}
@media (min-width: 1025px) {
    .about-image-wrap img {
        min-height: 332px;
        max-height: 600px;
    }
}

/* ═══════════════════════════════════════════════════
   MİSYON & VİZYON
═══════════════════════════════════════════════════ */
.section-mission-vision {
    background: #120522;
    color: #fff;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}
.mv-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 72px 24px;
    width: 100%;
}
@media (min-width: 640px) {
    .mv-inner { padding: 90px 40px; }
}
@media (min-width: 1025px) {
    .mv-inner { padding: 110px 123px; }
}

.mv-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 56px;
}
@media (min-width: 1025px) {
    .mv-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
}

.mv-block-title {
    font-family: 'Rubik', sans-serif;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 0.02em;
    color: #fff;
}
@media (min-width: 640px) { .mv-block-title { font-size: 22px; } }
@media (min-width: 1025px) { .mv-block-title { font-size: 24px; letter-spacing: 0.04em; } }

.mv-block-line {
    margin-top: 10px;
    height: 2px;
    width: 140px;
    background: rgba(255,255,255,0.7);
}

.mv-block-subtitle {
    margin-top: 20px;
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: rgba(255,255,255,0.9);
}
@media (min-width: 640px) { .mv-block-subtitle { font-size: 15px; margin-top: 24px; } }
@media (min-width: 1025px) { .mv-block-subtitle { font-size: 16px; margin-top: 28px; } }

.mv-block-text {
    margin-top: 14px;
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.6;
    color: rgba(255,255,255,0.7);
    max-width: 560px;
}
@media (min-width: 640px) { .mv-block-text { font-size: 15px; } }
@media (min-width: 1025px) {
    .mv-block-text {
        font-size: 16px;
        line-height: 1.19;
        max-width: 521px;
    }
}

/* ═══════════════════════════════════════════════════
   İŞLERİMİZE GÖZ ATIN — Figma Layout
═══════════════════════════════════════════════════ */
.section-about-works {
    background: #fff;
    padding: 60px 24px 80px;
}
@media (min-width: 768px) {
    .section-about-works { padding: 80px 40px 100px; }
}
@media (min-width: 1025px) {
    .section-about-works { padding: 80px 83px 120px; }
}
.about-works-inner {
    max-width: 1440px;
    margin: 0 auto;
}
.about-works-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 86px;
}
.about-works-title {
    font-family: 'Rubik', sans-serif;
    font-size: 28px;
    font-weight: 400;
    color: #C41027;
    line-height: 1.3;
}
@media (min-width: 1025px) {
    .about-works-title { font-size: 40px; letter-spacing: 0.06em; }
}
.about-works-title a {
    color: #C41027;
    text-decoration: none;
    display: inline-block;
}
.about-works-title a .arrow-icon {
    display: inline-block;
    font-size: 24px;
    margin-left: 10px;
    transition: transform 0.25s;
}
.about-works-title a:hover .arrow-icon {
    transform: translate(5px, 5px);
}

/* ── Figma 3-kart asimetrik grid ── */
.about-works-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    align-items: start;
}
@media (min-width: 768px) {
    .about-works-grid {
        grid-template-columns: 494fr 321fr 384fr;
        grid-template-rows: auto;
        gap: 37px;
        align-items: start;
    }
}

/* Kart 1: Sol — büyük, yatay (landscape) */
.about-work-card {
    display: block;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    background: #000;
    border-radius: 0;
}
.about-work-card:nth-child(1) {
    aspect-ratio: 494 / 314;
}
/* Kart 2: Orta — küçük, yatay (landscape) */
.about-work-card:nth-child(2) {
    aspect-ratio: 321 / 204;
}
/* Kart 3: Sağ — dikey (portrait, uzun) */
.about-work-card:nth-child(3) {
    aspect-ratio: 384 / 492;
}

@media (min-width: 768px) {
    .about-work-card:nth-child(2) {
        align-self: start;
    }
}

@media (max-width: 767px) {
    .about-work-card:nth-child(1),
    .about-work-card:nth-child(2),
    .about-work-card:nth-child(3) {
        aspect-ratio: 4 / 3;
    }
}

.about-work-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.45s ease;
    display: block;
}
.about-work-card:hover img {
    transform: scale(1.04);
}
.about-work-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 100px;
    background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 100%);
    pointer-events: none;
    z-index: 1;
}
.about-work-card-label {
    position: absolute;
    bottom: 16px;
    left: 18px;
    font-family: 'Rubik', sans-serif;
    font-size: 12px;
    font-weight: 400;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    z-index: 2;
    pointer-events: none;
    padding-bottom: 3px;
    border-bottom: 1.5px solid transparent;
    transition: border-color 0.3s ease, color 0.3s ease;
}
.about-work-card:hover .about-work-card-label {
    color: #fff;
    border-bottom-color: rgba(255,255,255,0.85);
}
.about-work-card-arrow { display: none; }
.about-work-card-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #1a1030, #0e0c22);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.08);
    font-size: 48px;
}
</style>
@endpush

@section('content')

{{-- Üst boşluk (navbar arkasında) --}}
<div class="about-hero-spacer"></div>

{{-- ══ BİZ KİMİZ — INTRO ══ --}}
<section class="section-about-intro">
    <div class="about-intro-inner">
        {{-- Üst bölüm --}}
        <div class="about-top">
            {{-- Sol: Kırmızı çizgi + Başlık + Açıklama --}}
            <div class="about-top-left">
                <div class="about-red-line"></div>
                <div>
                    <h1 class="about-title">Biz <br>Kimiz?</h1>
                    <p class="about-desc">
                        {{ $settings['about_description'] ?? 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel bir ekibiz.' }}
                    </p>
                </div>
            </div>

            {{-- Sağ: İletişim bilgileri --}}
            <div class="about-top-right">
                <p class="about-contact-address">{{ $settings['contact_address'] ?? 'Oruçreis Mah. Tekstilkent Cad. Tekstilkent GD3 Blok No:10AG, İç Kapı No:Z12, 34235, Esenler/İstanbul' }}</p>
                <a class="about-contact-link" href="mailto:{{ $settings['contact_email'] ?? 'info@albusproduction.com' }}">
                    {{ $settings['contact_email'] ?? 'info@albusproduction.com' }}
                </a>
                <a class="about-contact-link" href="{{ $settings['instagram_url'] ?? 'https://instagram.com' }}" target="_blank" rel="noreferrer">
                    Instagram
                </a>
            </div>
        </div>

        {{-- Görsel --}}
        <div class="about-image-wrap">
            @if(!empty($settings['about_image']))
                <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="Albus Production" loading="lazy">
            @else
                <div style="width:100%;max-width:780px;height:332px;background:#1a1a2e;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <span style="color:rgba(255,255,255,0.15);font-size:48px;">📷</span>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ══ MİSYON & VİZYON ══ --}}
<section class="section-mission-vision">
    <div class="mv-inner">
        <div class="mv-grid">
            {{-- MİSYON --}}
            <div class="mv-block">
                <h2 class="mv-block-title">MİSYONUMUZ</h2>
                <div class="mv-block-line"></div>
                <h3 class="mv-block-subtitle">
                    {{ $settings['mission_subtitle'] ?? 'Albus Production Olarak Sahnenize Hayat Veriyoruz' }}
                </h3>
                <p class="mv-block-text">
                    {{ $settings['mission_text'] ?? 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde yaratıcı fikirleri ileri teknolojiyle buluşturuyor; projenizi eksiksiz ve sorunsuz şekilde hayata geçiriyoruz. Her ayrıntıyı sizin yerinize biz düşünürken, siz sadece izleyicilerinize unutulmaz bir deneyim sunmanın keyfini yaşayın.' }}
                </p>
            </div>

            {{-- VİZYON --}}
            <div class="mv-block">
                <h2 class="mv-block-title">VİZYONUMUZ</h2>
                <div class="mv-block-line"></div>
                <p class="mv-block-text" style="margin-top: 18px;">
                    {{ $settings['vision_text_1'] ?? 'Yeni teknolojileri ve anlatım biçimlerini cesurca kullanarak, sahneyi bir iletişim alanı olarak yeniden tanımlamak; izleyiciyle duygusal ve estetik bağ kuran deneyimler üretmek istiyoruz.' }}
                </p>
                <p class="mv-block-text" style="margin-top: 18px;">
                    {{ $settings['vision_text_2'] ?? 'Amacımız yalnızca teknik yeterliliğiyle değil vizyoner bakış açısıyla da tercih edilen, ilham veren, ulusal ve uluslararası projelerde güvenilir bir iş ortağı olmaktır.' }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ══ İŞLERİMİZE GÖZ ATIN ══ --}}
@if($projects->isNotEmpty())
<section class="section-about-works">
    <div class="about-works-inner">
        {{-- Başlık --}}
        <div class="about-works-header">
            <h2 class="about-works-title">
                <a href="{{ route('portfolio') }}">
                    İşlerimize<br>Göz Atın <span class="arrow-icon">↘</span>
                </a>
            </h2>
        </div>

        {{-- Figma 3-kart asimetrik grid --}}
        <div class="about-works-grid">
            @foreach($projects->take(3) as $project)
            <a href="{{ route('portfolio.show', $project->slug) }}" class="about-work-card">
                @if($project->cover_image)
                    <img src="{{ Storage::url($project->cover_image) }}"
                         alt="{{ $project->title }}" loading="lazy">
                @else
                    <div class="about-work-card-placeholder">🎬</div>
                @endif
                <span class="about-work-card-label">{{ $project->title }}</span>
                <span class="about-work-card-arrow">
                    <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── Scroll-based grow effect on about section image ──
    const aboutImg = document.querySelector('.about-image-wrap img');
    if (!aboutImg) return;

    function handleScroll() {
        const wrap = aboutImg.closest('.about-image-wrap');
        const rect = wrap.getBoundingClientRect();
        const windowH = window.innerHeight;

        // progress: 0 when element enters viewport from bottom, 1 when it reaches center/top
        const start = windowH;
        const end = windowH * 0.15;
        const current = rect.top;

        let progress = 1 - (current - end) / (start - end);
        progress = Math.max(0, Math.min(1, progress));

        // Scale from 0.55 → 1.0
        const scale = 0.55 + progress * 0.45;
        // Border radius shrinks from 8px to 0
        const radius = 8 * (1 - progress);
        aboutImg.style.transform = 'scale(' + scale + ')';
        aboutImg.style.borderRadius = radius + 'px';
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
});
</script>
@endpush
