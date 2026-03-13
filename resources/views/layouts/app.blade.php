<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Albus Production')</title>
    <meta name="description" content="@yield('description', 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde profesyonel çözümler.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red: #E8001C;
            --blue: #0B2FCA;
            --dark: #0a0a0a;
            --white: #ffffff;
            --gray: #888;
            --light-gray: #f5f5f5;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #111;
            overflow-x: hidden;
        }

        /* ── NAV ──────────────────────────────────────── */
        .nav {
            position: absolute;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 106px 0 0 125px;
            pointer-events: none;
        }
        .nav > * { pointer-events: all; }
        .nav-logo {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1px;
            line-height: 1;
        }
        .nav-logo img {
            height: 49px !important;
            width: 205px !important;
            max-height: none !important;
        }
        .nav-logo .logo-prod {
            font-size: 8px;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-right: 3px;
            line-height: 1;
            align-self: center;
        }
        .nav-logo .logo-main {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -1px;
        }
        .nav-logo .logo-a { color: var(--red); }
        .nav-hamburger {
            position: absolute;
            top: 291px;
            left: 125px;
            width: 68px;
            height: 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            pointer-events: all;
        }
        .nav-hamburger span {
            display: block;
            width: 100%;
            height: 3px;
            background: #7B7D97;
            transition: all 0.3s;
            transform-origin: center;
        }
        .nav-hamburger:hover span { background: #a8aabe; }
        .nav-hamburger.open span:nth-child(1) { transform: translateY(15.5px) rotate(45deg); }
        .nav-hamburger.open span:nth-child(2) { opacity: 0; }
        .nav-hamburger.open span:nth-child(3) { transform: translateY(-15.5px) rotate(-45deg); }

        /* ── MENU OVERLAY ─────────────────────────────── */
        .menu-overlay {
            position: fixed;
            inset: 0;
            background: #0e0c22;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            transform: translateY(-100%);
            transition: transform 0.5s cubic-bezier(0.77,0,0.175,1);
            overflow: hidden;
        }
        .menu-overlay.open { transform: translateY(0); }

        .menu-overlay-inner {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 0 calc(100% / 12) 0;
        }
        @media (max-width: 768px) {
            .menu-overlay-inner { padding: 0 24px; }
        }

        /* Top: logo */
        .menu-overlay-top {
            display: flex;
            align-items: flex-start;
            padding-top: 56px;
            margin-bottom: 56px;
        }
        @media (max-width: 768px) {
            .menu-overlay-top { padding-top: 32px; margin-bottom: 32px; }
        }

        /* Middle: ✕ + links */
        .menu-middle {
            flex: 1;
            display: flex;
            align-items: flex-start;
            gap: 48px;
        }
        @media (max-width: 768px) {
            .menu-middle { gap: 24px; }
        }

        /* Close ✕ */
        .menu-overlay-close {
            background: none;
            border: none;
            cursor: pointer;
            width: 44px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 4px;
            padding: 0;
            position: relative;
        }
        .menu-overlay-close::before,
        .menu-overlay-close::after {
            content: '';
            position: absolute;
            width: 28px;
            height: 2px;
            background: #7B7D97;
            transition: background 0.2s;
        }
        .menu-overlay-close::before { transform: rotate(45deg); }
        .menu-overlay-close::after { transform: rotate(-45deg); }
        .menu-overlay-close:hover::before,
        .menu-overlay-close:hover::after { background: #fff; }

        /* Links — 64px semibold */
        .menu-links {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .menu-links a {
            font-size: 64px;
            font-weight: 600;
            color: #7B7D97;
            text-decoration: none;
            transition: color 0.25s;
            line-height: 1.0;
            letter-spacing: 0.02em;
            padding: 12px 0;
        }
        @media (max-width: 1024px) {
            .menu-links a { font-size: clamp(36px, 6vw, 64px); }
        }
        .menu-links a:nth-child(1) { color: #D9D9D9; }
        .menu-links a:nth-child(2) { color: #D9D9D9; }
        .menu-links a:nth-child(3) { color: #7B7D97; }
        .menu-links a:hover { color: #FFFFFF; }
        .menu-links a.active { color: #FFFFFF; }

        /* Bottom bar */
        .menu-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 32px;
            padding: 28px 0 48px;
        }
        @media (max-width: 768px) {
            .menu-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
                padding: 20px 0 32px;
            }
        }
        .menu-bottom-left {
            display: flex;
            align-items: flex-start;
            gap: 0;
        }
        .menu-bottom-label {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
            white-space: nowrap;
            padding-right: 20px;
            border-right: 1px solid rgba(255,255,255,0.12);
            line-height: 1.7;
        }
        .menu-bottom-desc {
            font-size: 12px;
            color: rgba(255,255,255,0.35);
            line-height: 1.7;
            padding-left: 20px;
            max-width: 460px;
        }
        .menu-bottom-instagram {
            font-size: 14px;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            transition: color 0.2s;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .menu-bottom-instagram:hover { color: #fff; }

        /* ── FOOTER ───────────────────────────────────── */
        .footer {
            background: #000;
            color: rgba(255,255,255,0.5);
        }

        /* Top black section: logo + info + button */
        .footer-top {
            background: #000;
            padding: 40px 24px 32px;
        }
        @media (min-width: 1025px) {
            .footer-top { padding: 56px 80px 40px; }
        }
        .footer-top-inner {
            max-width: 1440px;
            margin: 0 auto;
        }

        /* Logo centered */
        .footer-logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 48px;
        }
        @media (min-width: 1025px) {
            .footer-logo-wrap { margin-bottom: 64px; }
        }
        .footer-logo {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .footer-logo img {
            height: auto;
            width: 180px;
        }
        @media (min-width: 1025px) {
            .footer-logo img { width: 227px; }
        }
        .footer-logo-text {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
        }
        .footer-logo-text .logo-dash { color: rgba(255,255,255,0.4); font-weight: 300; }
        .footer-logo-text .logo-a { color: var(--red); }

        /* Info row: left | divider (logo center) | right button */
        .footer-info-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
            align-items: center;
        }
        @media (min-width: 1025px) {
            .footer-info-row {
                grid-template-columns: 1fr auto 1fr;
                gap: 0;
                align-items: center;
            }
        }

        /* Left: email + instagram inline, address below */
        .footer-left {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        @media (min-width: 1025px) {
            .footer-left { padding-right: 56px; }
        }
        .footer-links-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 24px;
        }
        @media (min-width: 1025px) {
            .footer-links-row { gap: 40px; }
        }
        .footer-info-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Rubik', sans-serif;
            font-size: 18px;
            font-weight: 400;
            letter-spacing: 0.06em;
            color: #D9D9D9;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-info-link:hover { color: #fff; }
        .footer-info-link .ext { font-size: 13px; color: rgba(217,217,217,0.6); }
        .footer-info-address {
            font-family: 'Rubik', sans-serif;
            font-size: 16px;
            font-weight: 300;
            line-height: 1.3;
            letter-spacing: 0.06em;
            color: #D9D9D9;
            max-width: 490px;
        }
        .footer-map-link {
            display: block;
            margin-top: 10px;
            border-radius: 6px;
            overflow: hidden;
            max-width: 220px;
            text-decoration: none;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .footer-map-link:hover { opacity: 0.95; }
        .footer-map {
            width: 100%;
            height: 70px;
            border: none;
            display: block;
            pointer-events: none;
        }

        /* Center divider — positioned exactly at logo center (50% of row) */
        .footer-divider {
            display: none;
        }
        @media (min-width: 1025px) {
            .footer-divider {
                display: block;
                width: 1px;
                height: 177px;
                background: rgba(217,217,217,0.4);
                flex-shrink: 0;
                align-self: center;
            }
        }

        /* Right: project button */
        .footer-right {
            display: flex;
            justify-content: flex-start;
        }
        @media (min-width: 1025px) {
            .footer-right {
                justify-content: flex-end;
                padding-left: 56px;
            }
        }
        .footer-project-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 246px;
            height: 90px;
            border: 1px solid rgba(217,217,217,0.35);
            border-radius: 12px;
            padding: 0 24px;
            background: transparent;
            color: rgba(217,217,217,0.7);
            text-decoration: none;
            cursor: pointer;
            font-family: 'Rubik', sans-serif;
            font-size: inherit;
            transition: border-color 0.25s, color 0.25s;
        }
        .footer-project-btn:hover {
            border-color: rgba(217,217,217,0.75);
            color: #D9D9D9;
        }
        .footer-project-btn-text {
            text-align: left;
            font-family: 'Rubik', sans-serif;
            font-size: 20px;
            font-weight: 300;
            color: rgba(217,217,217,0.7);
            line-height: 1.44;
        }
        .footer-project-btn:hover .footer-project-btn-text { color: #D9D9D9; }
        .footer-project-btn-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: color 0.2s;
        }
        .footer-project-btn-arrow svg {
            width: 20px;
            height: 18px;
            stroke: rgba(217,217,217,0.6);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke 0.2s;
        }
        .footer-project-btn:hover .footer-project-btn-arrow svg { stroke: #D9D9D9; }

        /* Footer background image section */
        .footer-bg-section {
            width: 100%;
            position: relative;
        }
        .footer-bg-section img {
            width: 100%;
            display: block;
            object-fit: cover;
            max-height: 700px;
        }

        /* ── PROJECT REQUEST MODAL ─────────────────────── */
        .prm-overlay {
            position: fixed;
            inset: 0;
            z-index: 2000;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }
        @media (min-width: 768px) {
            .prm-overlay {
                padding: 40px 60px;
            }
        }
        @media (min-width: 1025px) {
            .prm-overlay {
                padding: 40px 80px;
            }
        }
        .prm-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .prm-box {
            background: #120522;
            border-radius: 0;
            padding: 48px 48px 44px;
            width: 100%;
            max-width: 572px;
            min-height: auto;
            position: relative;
            transform: translateY(30px) scale(0.96);
            transition: transform 0.35s ease;
            font-family: 'Rubik', sans-serif;
        }
        @media (min-width: 768px) {
            .prm-box {
                padding: 56px 56px 52px;
                min-height: 665px;
                display: flex;
                flex-direction: column;
            }
        }
        .prm-overlay.open .prm-box {
            transform: translateY(0) scale(1);
        }
        .prm-close {
            position: absolute;
            top: 32px; right: 40px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            font-size: 32px;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
            font-weight: 300;
        }
        .prm-close:hover { color: #fff; }
        .prm-title {
            font-family: 'Rubik', sans-serif;
            font-size: 18px;
            font-weight: 300;
            color: #BBBBBB;
            line-height: 1.12;
            letter-spacing: 0.06em;
            margin-bottom: 40px;
            max-width: 423px;
            paragraph-spacing: 9px;
        }
        .prm-form-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .prm-field {
            margin-bottom: 8px;
        }
        .prm-field input,
        .prm-field textarea {
            width: 100%;
            max-width: 360px;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 14px 0;
            font-family: 'Rubik', sans-serif;
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 0.04em;
            color: #BBBBBB;
            outline: none;
            transition: border-color 0.2s;
            text-align: left;
            direction: ltr;
        }
        .prm-field input::placeholder,
        .prm-field textarea::placeholder {
            color: #D9D9D9;
            font-weight: 300;
        }
        .prm-field input:focus,
        .prm-field textarea:focus {
            border-bottom-color: rgba(255,255,255,0.5);
        }
        .prm-field textarea {
            resize: none;
            min-height: 43px;
            max-width: 360px;
            overflow-y: auto;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: pre-wrap;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .prm-field textarea::-webkit-scrollbar {
            display: none;
        }
        .prm-submit-wrap {
            margin-top: auto;
            padding-top: 24px;
            display: flex;
            justify-content: flex-end;
        }
        .prm-submit {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.55);
            font-size: 15px;
            font-family: 'Rubik', sans-serif;
            font-weight: 300;
            letter-spacing: 0.04em;
            cursor: pointer;
            padding: 8px 0;
            transition: color 0.2s;
        }
        .prm-submit:hover { color: #fff; }
        .prm-submit .arrow { font-size: 16px; }
        .prm-success {
            color: rgba(255,255,255,0.85);
            font-size: 15px;
            text-align: center;
            padding: 40px 0;
        }

        /* ── UTILS ────────────────────────────────────── */
        .container { max-width: 1320px; margin: 0 auto; padding: 0 48px; }
        .btn-red {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--red); color: #fff;
            padding: 14px 28px; border-radius: 4px;
            text-decoration: none; font-size: 14px; font-weight: 500;
            border: none; cursor: pointer; transition: opacity 0.2s;
        }
        .btn-red:hover { opacity: 0.85; }

        @media (max-width: 1024px) {
            .footer-content-grid { gap: 32px; }
            .nav { padding: 60px 0 0 48px; }
            .nav-hamburger { top: 180px; left: 48px; width: 56px; height: 28px; }
            .nav-hamburger span { height: 3px; }
        }
        @media (max-width: 768px) {
            .nav { padding: 36px 0 0 24px; }
            .nav-hamburger { top: 120px; left: 24px; width: 48px; height: 24px; }
            .nav-hamburger span { height: 2px; }
            .nav-hamburger.open span:nth-child(1) { transform: translateY(10.5px) rotate(45deg); }
            .nav-hamburger.open span:nth-child(3) { transform: translateY(-10.5px) rotate(-45deg); }
            .nav.scrolled { padding: 36px 0 0 24px; }
            .container { padding: 0 24px; }
        }
        @media (max-width: 480px) {
        }
    </style>
    @stack('styles')
</head>
<body class="@yield('body_class')">

<!-- Navigation -->
<nav class="nav" id="mainNav">
    <a href="{{ route('home') }}" class="nav-logo">
        @if($siteLogo = \App\Models\SiteSetting::get('site_logo'))
            <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ \App\Models\SiteSetting::get('site_name', 'Albus Production') }}">
        @else
            <span class="logo-prod">PRODUCTION</span>
            <span class="logo-main">—<span class="logo-a">A</span>LBUS</span>
        @endif
    </a>
    <button class="nav-hamburger" id="menuBtn" aria-label="Menü">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- Menu Overlay -->
<div class="menu-overlay" id="menuOverlay">
    <div class="menu-overlay-inner">
        <div class="menu-overlay-top">
            <a href="{{ route('home') }}" class="nav-logo" onclick="document.getElementById('menuOverlay').classList.remove('open');document.getElementById('menuBtn').classList.remove('open')">
                @if($siteLogo)
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ \App\Models\SiteSetting::get('site_name', 'Albus Production') }}" style="max-height:49px; width: auto;">
                @else
                    <span class="logo-prod">PRODUCTION</span>
                    <span class="logo-main">—<span class="logo-a">A</span>LBUS</span>
                @endif
            </a>
        </div>

        <div class="menu-middle">
            <button class="menu-overlay-close" id="menuClose" aria-label="Kapat"></button>
            <nav class="menu-links">
                <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio*') ? 'active' : '' }}">Portfolyo</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Hizmetlerimiz</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Biz Kimiz</a>
            </nav>
        </div>

        <div class="menu-bottom">
            <div class="menu-bottom-left">
                <div class="menu-bottom-label">Biz Kimiz?</div>
                <div class="menu-bottom-desc">
                    Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri
                    teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel
                    bir ekibiz.
                </div>
            </div>
            <a href="{{ \App\Models\SiteSetting::get('instagram_url', 'https://www.instagram.com/albusproduction') }}" target="_blank" rel="noopener" class="menu-bottom-instagram">Instagram ↗</a>
        </div>
    </div>
</div>

@yield('content')

<!-- Footer -->
<footer class="footer" id="contact">
    {{-- ── Black top section: Logo + Info + Button ── --}}
    <div class="footer-top">
        <div class="footer-top-inner">
            {{-- Logo centered --}}
            <div class="footer-logo-wrap">
                <a href="{{ route('home') }}" class="footer-logo">
                    @php $footerLogo = \App\Models\SiteSetting::get('footer_logo') ?: (\App\Models\SiteSetting::get('site_logo') ?? null); @endphp
                    @if($footerLogo)
                        <img src="{{ asset('storage/' . $footerLogo) }}" alt="{{ \App\Models\SiteSetting::get('site_name', 'Albus Production') }}">
                    @else
                        <span class="footer-logo-text"><span class="logo-dash">—</span><span class="logo-a">A</span>LBUS</span>
                    @endif
                </a>
            </div>

            {{-- Info row: left | divider | right --}}
            <div class="footer-info-row">
                {{-- Left: email + instagram inline, address below --}}
                <div class="footer-left">
                    <div class="footer-links-row">
                        <a href="mailto:{{ \App\Models\SiteSetting::get('contact_email', 'info@albusproduction.com') }}" class="footer-info-link">
                            {{ \App\Models\SiteSetting::get('contact_email', 'info@albusproduction.com') }} <span class="ext">↗</span>
                        </a>
                        <a href="{{ \App\Models\SiteSetting::get('instagram_url', 'https://www.instagram.com/albusproduction') }}" target="_blank" rel="noopener" class="footer-info-link">
                            Instagram <span class="ext">↗</span>
                        </a>
                    </div>
                    @php $footerAddress = \App\Models\SiteSetting::get('contact_address', 'Orucreis Mah. Tekstilkent Cad. Tekstilkent GD3 Blok No:10AG, İç Kapı No:Z12, 34235, Esenler/İstanbul'); @endphp
                    <p class="footer-info-address">{{ $footerAddress }}</p>
                    <a href="https://www.google.com/maps/place/Albus+Production/@41.0622287,28.8681472,17z/data=!3m1!4b1!4m6!3m5!1s0x14cab14084e49377:0xcf9d9c54149b4b4d!8m2!3d41.0622247!4d28.8707221!16s%2Fg%2F11yhhc73nk" target="_blank" rel="noopener" class="footer-map-link">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3009.5!2d28.8681472!3d41.0622287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab14084e49377:0xcf9d9c54149b4b4d!2sAlbus+Production!5e0!3m2!1str!2str!4v1"
                            class="footer-map"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen>
                        </iframe>
                    </a>
                </div>

                {{-- Center divider --}}
                <div class="footer-divider"></div>

                {{-- Right: project request button --}}
                <div class="footer-right">
                    <button type="button" class="footer-project-btn" id="openProjectModal">
                        <div class="footer-project-btn-text">Proje Talebi<br>Oluştur</div>
                        <div class="footer-project-btn-arrow">
                            <svg viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <line x1="2" y1="2" x2="18" y2="16"/>
                                <polyline points="8,16 18,16 18,6"/>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Background image section (below black area) ── --}}
    @php $footerBg = \App\Models\SiteSetting::get('footer_bg'); @endphp
    @if($footerBg)
        <div class="footer-bg-section">
            <img src="{{ asset('storage/' . $footerBg) }}" alt="Albus Production" loading="lazy">
        </div>
    @endif
</footer>

<!-- Project Request Modal -->
<div class="prm-overlay" id="projectModal">
    <div class="prm-box">
        <button type="button" class="prm-close" id="closeProjectModal">✕</button>
        <p class="prm-title">Sizinle İletişime Geçmemiz için<br>lütfen Formu Doldurun.</p>
        <form action="{{ route('contact.send') }}" method="POST" id="projectModalForm" class="prm-form-wrap">
            @csrf
            <div>
                <div class="prm-field">
                    <input type="text" name="name" placeholder="İsim Soyisim" required>
                </div>
                <div class="prm-field">
                    <input type="text" name="company" placeholder="Markanız">
                </div>
                <div class="prm-field">
                    <input type="tel" name="phone" placeholder="İletişim Numarası">
                </div>
                <div class="prm-field">
                    <input type="email" name="email" placeholder="Mail Adresiniz" required>
                </div>
                <div class="prm-field">
                    <textarea name="message" placeholder="Proje Hakkında" rows="1" required></textarea>
                </div>
            </div>
            <input type="hidden" name="subject" value="Proje Talebi (Footer Modal)">
            <div class="prm-submit-wrap">
                <button type="submit" class="prm-submit">Gönder <span class="arrow">↘</span></button>
            </div>
        </form>
    </div>
</div>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const menuClose = document.getElementById('menuClose');
    const menuOverlay = document.getElementById('menuOverlay');
    const nav = document.getElementById('mainNav');

    function openMenu() {
        menuOverlay.classList.add('open');
        menuBtn.classList.add('open');
    }
    function closeMenu() {
        menuOverlay.classList.remove('open');
        menuBtn.classList.remove('open');
    }

    menuBtn.addEventListener('click', openMenu);
    menuClose.addEventListener('click', closeMenu);

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeMenu();
    });

    menuOverlay.querySelectorAll('.menu-links a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 60);
    });

    /* ── Project Request Modal ── */
    const projectModal = document.getElementById('projectModal');
    const openBtn = document.getElementById('openProjectModal');
    const closeBtn = document.getElementById('closeProjectModal');

    if (projectModal && openBtn && closeBtn) {
        openBtn.addEventListener('click', () => {
            projectModal.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
        closeBtn.addEventListener('click', () => {
            projectModal.classList.remove('open');
            document.body.style.overflow = '';
        });
        projectModal.addEventListener('click', (e) => {
            if (e.target === projectModal) {
                projectModal.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && projectModal.classList.contains('open')) {
                projectModal.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    }

    /* ── Auto-grow textarea ── */
    const prmTextarea = document.querySelector('#projectModalForm textarea');
    if (prmTextarea) {
        prmTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }

    /* ── Modal Form AJAX Submit ── */
    const prmForm = document.getElementById('projectModalForm');
    if (prmForm) {
        prmForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = prmForm.querySelector('button[type=submit]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';

            fetch(prmForm.action, {
                method: 'POST',
                body: new FormData(prmForm),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => {
                if (res.ok || res.redirected) {
                    prmForm.innerHTML = '<div class="prm-success"><p style="font-size:22px;margin-bottom:12px;">✓</p><p>Mesajınız alındı.<br>En kısa sürede sizinle iletişime geçeceğiz.</p></div>';
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Gönder <span class="arrow">↘</span>';
                    alert('Bir hata oluştu, lütfen tekrar deneyin.');
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Gönder <span class="arrow">↘</span>';
                alert('Bir hata oluştu, lütfen tekrar deneyin.');
            });
        });
    }
</script>
@stack('scripts')
</body>
</html>
