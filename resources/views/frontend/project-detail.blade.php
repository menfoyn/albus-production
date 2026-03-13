@extends('layouts.app')

@section('title', $project->title . ' – Albus Production')
@section('description', $project->short_description)

@section('body_class', 'page-project-detail')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════════
   PROJECT DETAIL — Figma-match layout
   ═══════════════════════════════════════════════════════ */

/* ── NAV OVERRIDE (project-detail) ──────────────────── */
body.page-project-detail .nav {
    display: flex !important;
    flex-direction: row !important;
    align-items: flex-start !important;
    justify-content: space-between !important;
    padding: 100px 775px 0 125px !important;
    gap: 0 !important;
}
body.page-project-detail .nav .nav-hamburger,
body.page-project-detail .nav #menuBtn {
    position: static !important;
    width: 68px !important;
    height: 34px !important;
    margin: 0 !important;
    flex-shrink: 0 !important;
}
body.page-project-detail .nav .nav-hamburger span,
body.page-project-detail .nav #menuBtn span {
    background: #fff !important;
}
body.page-project-detail .nav .nav-logo {
    margin-left: 70px !important;
}
@media (max-width: 1024px) {
    body.page-project-detail .nav {
        padding: 60px 0 0 48px !important;
        gap: 0 !important;
        justify-content: space-between !important;
    }
    body.page-project-detail .nav .nav-hamburger,
    body.page-project-detail .nav #menuBtn {
        width: 56px !important;
        height: 28px !important;
    }
}
@media (max-width: 768px) {
    body.page-project-detail .nav {
        padding: 36px 24px 0 24px !important;
    }
    body.page-project-detail .nav .nav-hamburger,
    body.page-project-detail .nav #menuBtn {
        width: 48px !important;
        height: 24px !important;
    }
}

/* ── HERO ───────────────────────────────────────────── */
.work-hero {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 560px;
    display: flex;
    flex-direction: column;
    background: #000;
    overflow: hidden;
}
.work-hero__image-area {
    position: relative;
    flex: 1;
    overflow: hidden;
}
.work-hero__image-area img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: {{ $project->hero_image_position ?? '50% 50%' }};
    transform: scale({{ $project->hero_image_zoom ?? 1 }});
    transform-origin: center center;
}
.work-hero__vignette {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 35% 35%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.18) 60%, rgba(0,0,0,0.45) 100%);
    pointer-events: none;
}
.work-hero__bar {
    width: 100%;
    height: 120px;
    background: #120522;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    padding: 0 101px;
}
@media (max-width: 1024px) {
    .work-hero__bar {
        height: 80px;
        padding: 0 40px;
    }
}
@media (max-width: 768px) {
    .work-hero__bar {
        height: 60px;
        padding: 0 24px;
    }
}
.work-hero__play-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-family: 'Rubik', sans-serif;
    font-size: 24px;
    font-weight: 300;
    color: #D9D9D9;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0;
    transition: color 0.2s;
}
.work-hero__play-btn:hover {
    color: #fff;
}
@media (max-width: 1024px) {
    .work-hero__play-btn { font-size: 20px; }
}
@media (max-width: 768px) {
    .work-hero__play-btn { font-size: 18px; }
}

/* ── VIDEO MODAL ────────────────────────────────────── */
.video-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0,0,0,0.80);
    align-items: center;
    justify-content: center;
}
.video-modal.open {
    display: flex;
}
.video-modal__inner {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 452px;
    height: 803px;
    max-height: 90vh;
    max-width: 90vw;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
}
.video-modal__inner video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.video-modal__inner video:fullscreen {
    width: auto;
    height: 100%;
    max-width: 100%;
    object-fit: contain;
    background: #000;
}
.video-modal__inner video:-webkit-full-screen {
    width: auto;
    height: 100%;
    max-width: 100%;
    object-fit: contain;
    background: #000;
}
.video-modal__close {
    position: absolute;
    top: 8px;
    right: 10px;
    z-index: 10;
    background: none;
    border: none;
    color: rgba(255,255,255,0.8);
    font-size: 36px;
    font-weight: 300;
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1;
}
.video-modal__close:hover {
    color: #fff;
}

/* ── INTRO SECTION ──────────────────────────────────── */
.work-intro {
    background: #fff;
    width: 100%;
}
.work-intro__container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 90px 83px;
}
@media (max-width: 1024px) {
    .work-intro__container { padding: 60px 40px; }
}
@media (max-width: 768px) {
    .work-intro__container { padding: 48px 24px; }
}
.work-intro__grid {
    display: grid;
    grid-template-columns: 452px 1fr;
    column-gap: 165px;
    row-gap: 0;
}
@media (max-width: 1200px) {
    .work-intro__grid { grid-template-columns: 380px 1fr; column-gap: 80px; }
}
@media (max-width: 1024px) {
    .work-intro__grid { grid-template-columns: 1fr; gap: 48px 0; }
}

/* Left column */
.work-intro__left {
    display: flex;
    flex-direction: column;
}
.work-intro__title-block {
    display: flex;
    align-items: flex-start;
    gap: 38px;
}
.work-intro__title-line {
    margin-top: 8px;
    width: 2px;
    height: 165px;
    background: #C41027;
    flex-shrink: 0;
}
.work-intro__title {
    font-family: 'Rubik', sans-serif;
    font-size: 48px;
    font-weight: 600;
    line-height: 1;
    color: #C41027;
    margin: 0;
    max-width: 280px;
}
@media (max-width: 768px) {
    .work-intro__title { font-size: 36px; }
}
.work-intro__description {
    margin-top: -12px;
    margin-left: 40px;
    max-width: 371px;
    font-family: 'Rubik', sans-serif;
    font-size: 20px;
    font-weight: 300;
    line-height: 1.19;
    letter-spacing: 0.04em;
    color: #442D84;
}
@media (max-width: 1024px) {
    .work-intro__description { margin-top: 32px; max-width: 100%; }
}
@media (max-width: 768px) {
    .work-intro__description { font-size: 17px; margin-left: 0; }
}

/* Left video */
.work-intro__left-video {
    margin-top: 77px;
    width: 100%;
    max-width: 452px;
    background: #000;
    overflow: hidden;
    position: relative;
}
.work-intro__left-video-inner {
    position: relative;
    width: 100%;
    height: 803px;
}
@media (max-width: 1024px) {
    .work-intro__left-video { max-width: 100%; margin-top: 32px; }
    .work-intro__left-video-inner { height: 520px; }
}
@media (max-width: 768px) {
    .work-intro__left-video-inner { height: 420px; }
}
.work-intro__left-video video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Right column */
.work-intro__right {
    display: flex;
    flex-direction: column;
    max-width: 664px;
    margin-left: auto;
}
@media (max-width: 1024px) {
    .work-intro__right { max-width: 100%; margin-left: 0; }
}
.work-intro__right-image {
    width: 100%;
    max-width: 664px;
    background: #000;
    overflow: hidden;
    position: relative;
}
.work-intro__right-image-inner {
    position: relative;
    width: 100%;
    height: 718px;
}
@media (max-width: 1024px) {
    .work-intro__right-image-inner { height: 520px; }
}
@media (max-width: 768px) {
    .work-intro__right-image-inner { height: 420px; }
}
.work-intro__right-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Quote block — grid layout matching reference */
.work-intro__quote {
    margin-top: 68px;
    margin-left: -80px;
}
@media (max-width: 1024px) {
    .work-intro__quote { margin-top: 48px; margin-left: 0; }
}
.work-intro__quote-grid {
    display: grid;
    grid-template-columns: 72px 14px 2px 24px 370px;
    align-items: start;
}
@media (max-width: 1024px) {
    .work-intro__quote-grid {
        grid-template-columns: 60px 10px 2px 16px 1fr;
    }
}
@media (max-width: 768px) {
    .work-intro__quote-grid {
        grid-template-columns: 52px 8px 2px 12px 1fr;
    }
}
.work-intro__quote-date {
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.19;
    letter-spacing: 0.04em;
    color: #C41027;
    height: 165px;
    display: flex;
    align-items: center;
}
@media (max-width: 1024px) {
    .work-intro__quote-date { height: auto; min-height: 80px; font-size: 13px; }
}
.work-intro__quote-line {
    width: 2px;
    height: 195px;
    background: #C41027;
}
@media (max-width: 1024px) {
    .work-intro__quote-line { height: 100%; min-height: 80px; }
}
.work-intro__quote-text {
    font-family: 'Rubik', sans-serif;
    font-size: 20px;
    font-weight: 300;
    line-height: 1.25;
    letter-spacing: 0.04em;
    color: #442D84;
    width: 370px;
    margin: 0;
}
@media (max-width: 1024px) {
    .work-intro__quote-text { width: 100%; margin-top: 0; font-size: 17px; }
}
@media (max-width: 768px) {
    .work-intro__quote-text { font-size: 15px; }
}

/* Second right image — hidden; gallery thumbs appear instead */
.work-intro__right-image--second {
    display: none;
}

/* ── GALLERY ────────────────────────────────────────── */
.work-gallery {
    background: #fff;
    width: 100%;
}
.work-gallery__container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 83px 90px;
}
@media (max-width: 768px) {
    .work-gallery__container { padding: 0 24px 48px; }
}
.work-gallery__grid-wrap {
    display: grid;
    grid-template-columns: 452px 1fr;
    column-gap: 165px;
}
@media (max-width: 1200px) {
    .work-gallery__grid-wrap { grid-template-columns: 380px 1fr; column-gap: 80px; }
}
@media (max-width: 1024px) {
    .work-gallery__grid-wrap { grid-template-columns: 1fr; }
}

/* Left column: spacer to align with intro */
.work-gallery__left {
    display: flex;
    flex-direction: column;
}
@media (max-width: 1024px) {
    .work-gallery__left { display: none; }
}

/* Right column: label + thumbs */
.work-gallery__right {
    display: flex;
    flex-direction: column;
}
@media (max-width: 1024px) {
    .work-gallery__right { padding-left: 0; }
}

.work-gallery__label {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    margin-bottom: 20px;
}
.work-gallery__label-icon {
    width: 14px; height: 14px; flex-shrink: 0;
}
.work-gallery__label-text {
    font-family: 'Rubik', sans-serif;
    font-size: 16px;
    font-weight: 400;
    letter-spacing: 0.04em;
    color: #C41027;
}
.work-gallery__thumbs {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 0;
}
.work-gallery__thumb {
    position: relative;
    width: 100%;
    aspect-ratio: 165 / 177;
    overflow: hidden;
    background: #111;
    flex-shrink: 0;
    cursor: pointer;
    border: none;
    padding: 0;
}
@media (max-width: 768px) {
    .work-gallery__thumbs {
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }
    .work-gallery__thumb {
        aspect-ratio: 165 / 177;
    }
}
.work-gallery__thumb img,
.work-gallery__thumb video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.work-gallery__thumb:hover img,
.work-gallery__thumb:hover video {
    transform: scale(1.04);
}

/* Play icon overlay for video thumbs */
.work-gallery__thumb-play {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    pointer-events: none;
}
.work-gallery__thumb-play svg {
    width: 36px;
    height: 36px;
    fill: rgba(255,255,255,0.85);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));
}

/* ── LIGHTBOX ───────────────────────────────────────── */
.work-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9998;
    background: rgba(0,0,0,0.92);
    align-items: center;
    justify-content: center;
}
.work-lightbox.open {
    display: flex;
}
.work-lightbox__inner {
    position: relative;
    width: 92vw;
    max-width: 1100px;
}
.work-lightbox__media {
    position: relative;
    height: 70vh;
    width: 100%;
    overflow: hidden;
    border-radius: 16px;
    background: #000;
    display: flex;
    align-items: center;
    justify-content: center;
}
.work-lightbox__media img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.work-lightbox__media video {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.work-lightbox__close {
    position: absolute;
    top: -52px;
    right: 0;
    background: none;
    border: none;
    color: rgba(255,255,255,0.8);
    font-size: 40px;
    font-weight: 300;
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1;
}
.work-lightbox__close:hover { color: #fff; }
.work-lightbox__prev,
.work-lightbox__next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.1);
    border: none;
    color: rgba(255,255,255,0.9);
    font-size: 28px;
    padding: 12px 16px;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.2s;
    line-height: 1;
}
.work-lightbox__prev:hover,
.work-lightbox__next:hover { background: rgba(255,255,255,0.2); }
.work-lightbox__prev { left: 8px; }
.work-lightbox__next { right: 8px; }
@media (max-width: 768px) {
    .work-lightbox__prev { left: 4px; }
    .work-lightbox__next { right: 4px; }
}
.work-lightbox__index {
    margin-top: 14px;
    text-align: center;
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    letter-spacing: 0.04em;
    color: rgba(255,255,255,0.7);
}

/* ── RELATED WORKS ──────────────────────────────────── */
.related-section {
    background: #fff;
    padding: 160px 0 120px;
}
@media (max-width: 1024px) {
    .related-section { padding: 80px 0 60px; }
}
@media (max-width: 768px) {
    .related-section { padding: 60px 0 48px; }
}
.related-section__container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 83px;
}
@media (max-width: 768px) {
    .related-section__container { padding: 0 24px; }
}
.related-header {
    display: flex;
    align-items: flex-end;
    gap: 13px;
    margin-bottom: 72px;
}
@media (max-width: 768px) {
    .related-header { margin-bottom: 36px; }
}
.related-title {
    font-family: 'Rubik', sans-serif;
    font-size: 40px;
    font-weight: 400;
    line-height: 1.3;
    letter-spacing: 0.06em;
    color: #C41027;
    margin: 0;
}
@media (max-width: 768px) {
    .related-title { font-size: 28px; }
}
.related-arrow {
    display: block;
    width: 30px;
    height: 30px;
    flex-shrink: 0;
    margin-bottom: 6px;
}
.related-grid {
    display: grid;
    grid-template-columns: 494fr 321fr 384fr;
    gap: 37px;
    align-items: start;
}
@media (max-width: 1024px) {
    .related-grid { gap: 20px; }
}
@media (max-width: 768px) {
    .related-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
}
.related-card {
    display: block;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    color: #fff;
    background: #000;
}
.related-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.related-card:hover img { transform: scale(1.04); }
.related-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 120px;
    background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 100%);
    pointer-events: none;
}
.related-card__label {
    position: absolute;
    bottom: 20px;
    left: 22px;
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.08em;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    z-index: 2;
    pointer-events: none;
    padding-bottom: 3px;
    border-bottom: 1.5px solid transparent;
    transition: border-color 0.3s ease, color 0.3s ease;
}
.related-card:hover .related-card__label {
    color: #fff;
    border-bottom-color: rgba(255,255,255,0.85);
}
/* Card height variants — matches Figma: 494×314, 321×204, 384×492 */
.related-card--large  { aspect-ratio: 494 / 314; }
.related-card--small  { aspect-ratio: 321 / 204; }
.related-card--tall   { aspect-ratio: 384 / 492; }

/* ── BOTTOM SHOWCASE ───────────────────────────────── */
.work-bottom-showcase {
    background: #0a0a0a;
    padding: 60px 0 80px;
    overflow: hidden;
}
.work-bottom-showcase__grid {
    display: flex;
    gap: 24px;
    justify-content: center;
    flex-wrap: wrap;
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 48px;
}
.work-bottom-showcase__item {
    width: calc(33.333% - 16px);
    aspect-ratio: 16/10;
    overflow: hidden;
    background: #111;
}
@media (max-width: 768px) {
    .work-bottom-showcase__item { width: calc(50% - 12px); }
}
.work-bottom-showcase__item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
</style>
@endpush

@section('content')
@php
    $heroImage = $project->cover_image ? Storage::url($project->cover_image) : null;
    $heroVideo = $project->hero_video ? Storage::url($project->hero_video) : null;
    $introVideo = $project->intro_video ? Storage::url($project->intro_video) : null;
    $introImage = $project->intro_image ? Storage::url($project->intro_image) : null;

    // Galeri medyaları
    $galleryMedia = $project->media;
    $galleryImages = $galleryMedia->where('type', 'image');
    $galleryVideos = $galleryMedia->where('type', 'video');

    // Tüm galeri öğeleri (images + videos) sıralı
    $allGallery = $galleryMedia->values();
@endphp

{{-- ═══════════════ HERO ═══════════════ --}}
<section class="work-hero">
    <div class="work-hero__image-area">
        @if($heroImage)
            <img src="{{ $heroImage }}" alt="{{ $project->title }}">
        @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#1a0010,#0a0a2a)"></div>
        @endif
        <div class="work-hero__vignette"></div>
    </div>

    @if($heroVideo)
    <div class="work-hero__bar">
        <button class="work-hero__play-btn" onclick="openHeroVideo()" type="button">
            Tanıtımı İzle ↘
        </button>
    </div>
    @else
    <div class="work-hero__bar"></div>
    @endif
</section>

{{-- ═══════════════ VIDEO MODAL ═══════════════ --}}
@if($heroVideo)
<div class="video-modal" id="heroVideoModal">
    <div class="video-modal__inner">
        <button class="video-modal__close" onclick="closeHeroVideo()" type="button">✕</button>
        <video id="heroVideoPlayer" controls preload="metadata">
            <source src="{{ $heroVideo }}" type="video/mp4">
            Tarayıcınız video oynatmayı desteklemiyor.
        </video>
    </div>
</div>
@endif

{{-- ═══════════════ INTRO ═══════════════ --}}
<section class="work-intro">
    <div class="work-intro__container">
        <div class="work-intro__grid">
            {{-- LEFT COLUMN --}}
            <div class="work-intro__left">
                {{-- Title block --}}
                <div class="work-intro__title-block">
                    <div class="work-intro__title-line"></div>
                    <div>
                        <h1 class="work-intro__title">
                            @if($project->client)
                                {!! nl2br(e($project->client)) !!}
                            @else
                                {!! nl2br(e($project->title)) !!}
                            @endif
                        </h1>
                    </div>
                </div>

                @if($project->description)
                    <p class="work-intro__description">{!! nl2br(e($project->description)) !!}</p>
                @elseif($project->short_description)
                    <p class="work-intro__description">{{ $project->short_description }}</p>
                @endif

                {{-- Left video --}}
                @if($introVideo)
                <div class="work-intro__left-video">
                    <div class="work-intro__left-video-inner">
                        <video autoplay muted loop playsinline>
                            <source src="{{ $introVideo }}" type="video/mp4">
                        </video>
                    </div>
                </div>
                @endif
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="work-intro__right">
                {{-- Right image --}}
                @if($introImage)
                <div class="work-intro__right-image">
                    <div class="work-intro__right-image-inner">
                        <img src="{{ $introImage }}" alt="{{ $project->title }}">
                    </div>
                </div>
                @elseif($heroImage)
                <div class="work-intro__right-image">
                    <div class="work-intro__right-image-inner">
                        <img src="{{ $heroImage }}" alt="{{ $project->title }}">
                    </div>
                </div>
                @endif

                {{-- Quote block with date + red line + text --}}
                @if($project->quote_text || $project->date)
                <div class="work-intro__quote">
                    <div class="work-intro__quote-grid">
                        {{-- Date --}}
                        <div class="work-intro__quote-date">
                            {{ $project->date ?? '' }}
                        </div>
                        {{-- gap --}}
                        <div></div>
                        {{-- Vertical red line --}}
                        <div class="work-intro__quote-line"></div>
                        {{-- gap --}}
                        <div></div>
                        {{-- Quote text --}}
                        <p class="work-intro__quote-text">{{ $project->quote_text ?? '' }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ GALLERY ═══════════════ --}}
@if($allGallery->isNotEmpty())
<section class="work-gallery">
    <div class="work-gallery__container">
        <div class="work-gallery__grid-wrap">
            {{-- Left column: spacer --}}
            <div class="work-gallery__left"></div>

            {{-- Right column: label + thumbs --}}
            <div class="work-gallery__right">
                <div class="work-gallery__label">
                    <svg class="work-gallery__label-icon" viewBox="0 0 14 14" aria-hidden="true">
                        <path d="M12.5 1.5 L1.5 12.5" stroke="#C41027" stroke-width="1.5" fill="none" />
                        <path d="M5.0 12.5 H1.5 V9.0" stroke="#C41027" stroke-width="1.5" fill="none" />
                    </svg>
                    <span class="work-gallery__label-text">Galeri</span>
                </div>

                <div class="work-gallery__thumbs">
                    @foreach($allGallery as $index => $media)
                    <button class="work-gallery__thumb" onclick="openLightbox({{ $index }})" type="button" aria-label="Galeri {{ $index + 1 }}">
                        @if($media->type === 'video')
                            <video src="{{ Storage::url($media->file_path) }}" muted preload="metadata"></video>
                            <div class="work-gallery__thumb-play">
                                <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" /></svg>
                            </div>
                        @else
                            <img src="{{ Storage::url($media->file_path) }}" alt="Galeri {{ $index + 1 }}">
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LIGHTBOX --}}
<div class="work-lightbox" id="workLightbox">
    <div class="work-lightbox__inner">
        <button class="work-lightbox__close" onclick="closeLightbox()" type="button">×</button>

        <div class="work-lightbox__media" id="lightboxMedia">
            {{-- Dynamically filled by JS --}}
        </div>

        <button class="work-lightbox__prev" onclick="lightboxPrev()" type="button">‹</button>
        <button class="work-lightbox__next" onclick="lightboxNext()" type="button">›</button>

        <div class="work-lightbox__index" id="lightboxIndex">1 / {{ $allGallery->count() }}</div>
    </div>
</div>
@endif

{{-- ═══════════════ RELATED WORKS ═══════════════ --}}
@if($related->isNotEmpty())
<section class="related-section">
    <div class="related-section__container">
        <div class="related-header">
            <h2 class="related-title">Diğer<br>İşlerimize<br>Göz Atın</h2>
            <svg class="related-arrow" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 2 L28 28" stroke="#C41027" stroke-width="3" stroke-linecap="round"/><path d="M28 28 H14" stroke="#C41027" stroke-width="3" stroke-linecap="round"/><path d="M28 28 V14" stroke="#C41027" stroke-width="3" stroke-linecap="round"/></svg>
        </div>

        <div class="related-grid">
            @foreach($related as $i => $rel)
                @php
                    $variants = ['large', 'small', 'tall'];
                    $variant = $variants[$i % 3];
                @endphp
                <a href="{{ route('portfolio.show', $rel->slug) }}" class="related-card related-card--{{ $variant }}">
                    @if($rel->cover_image)
                        <img src="{{ Storage::url($rel->cover_image) }}" alt="{{ $rel->title }}">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#1a1030,#0e0c22)"></div>
                    @endif
                    <span class="related-card__label">{{ strtoupper($rel->client ?? $rel->title) }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif


@endsection

@push('scripts')
<script>
/* ── Hero Video Modal ──────────────────────────── */
function openHeroVideo() {
    const modal = document.getElementById('heroVideoModal');
    const video = document.getElementById('heroVideoPlayer');
    if (!modal || !video) return;
    modal.classList.add('open');
    video.currentTime = 0;
    video.play().catch(() => {});
    document.body.style.overflow = 'hidden';
}

function closeHeroVideo() {
    const modal = document.getElementById('heroVideoModal');
    const video = document.getElementById('heroVideoPlayer');
    if (!modal) return;
    modal.classList.remove('open');
    if (video) { video.pause(); video.currentTime = 0; }
    document.body.style.overflow = '';
}

// Click outside to close hero video
const heroModal = document.getElementById('heroVideoModal');
if (heroModal) {
    heroModal.addEventListener('click', function(e) {
        if (e.target === this) closeHeroVideo();
    });
}

/* ── Gallery Lightbox ──────────────────────────── */
const galleryData = @json($allGallery->map(fn($m) => [
    'src' => Storage::url($m->file_path),
    'type' => $m->type,
])->values());

let currentIndex = 0;

function openLightbox(index) {
    currentIndex = index;
    renderLightbox();
    document.getElementById('workLightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lb = document.getElementById('workLightbox');
    if (!lb) return;
    lb.classList.remove('open');
    // Pause any playing video
    const vid = lb.querySelector('video');
    if (vid) { vid.pause(); }
    document.body.style.overflow = '';
}

function lightboxPrev() {
    if (galleryData.length === 0) return;
    // Pause current video before switching
    const container = document.getElementById('lightboxMedia');
    if (container) { const v = container.querySelector('video'); if (v) v.pause(); }
    currentIndex = (currentIndex - 1 + galleryData.length) % galleryData.length;
    renderLightbox();
}

function lightboxNext() {
    if (galleryData.length === 0) return;
    // Pause current video before switching
    const container = document.getElementById('lightboxMedia');
    if (container) { const v = container.querySelector('video'); if (v) v.pause(); }
    currentIndex = (currentIndex + 1) % galleryData.length;
    renderLightbox();
}

function renderLightbox() {
    const container = document.getElementById('lightboxMedia');
    const indexEl = document.getElementById('lightboxIndex');
    if (!container || galleryData.length === 0) return;

    const item = galleryData[currentIndex];

    if (item.type === 'video') {
        container.innerHTML = '<video src="' + item.src + '" controls autoplay style="max-width:100%;max-height:100%;object-fit:contain;border-radius:4px"></video>';
    } else {
        container.innerHTML = '<img src="' + item.src + '" alt="Galeri ' + (currentIndex + 1) + '" style="max-width:100%;max-height:100%;object-fit:contain">';
    }

    if (indexEl) {
        indexEl.textContent = (currentIndex + 1) + ' / ' + galleryData.length;
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lb = document.getElementById('workLightbox');
    const vm = document.getElementById('heroVideoModal');

    if (lb && lb.classList.contains('open')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') lightboxNext();
        if (e.key === 'ArrowLeft') lightboxPrev();
        return;
    }

    if (vm && vm.classList.contains('open')) {
        if (e.key === 'Escape') closeHeroVideo();
    }
});

// Click outside lightbox content to close
const workLightbox = document.getElementById('workLightbox');
if (workLightbox) {
    workLightbox.addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
}

/* ── Touch/Swipe support for lightbox ──────────── */
let touchStartX = null;
const lightboxInner = document.querySelector('.work-lightbox__inner');
if (lightboxInner) {
    lightboxInner.addEventListener('touchstart', function(e) {
        touchStartX = e.touches[0]?.clientX ?? null;
    }, { passive: true });

    lightboxInner.addEventListener('touchend', function(e) {
        const endX = e.changedTouches[0]?.clientX ?? null;
        if (touchStartX === null || endX === null) return;
        const dx = endX - touchStartX;
        touchStartX = null;
        if (Math.abs(dx) < 40) return;
        if (dx < 0) lightboxNext();
        else lightboxPrev();
    });
}
</script>
@endpush
