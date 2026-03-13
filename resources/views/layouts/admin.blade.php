<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') – Albus Production</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --red: #E8001C;
            --dark: #0f0f0f;
            --sidebar-w: 240px;
            --sidebar-bg: #12102a;
        }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #f5f5f5; color: #111; display: flex; min-height: 100vh; }

        /* ── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-logo {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            display: block;
        }
        .sidebar-logo span { color: var(--red); }
        .sidebar-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.3);
            padding: 20px 24px 8px;
        }
        .sidebar-nav { flex: 1; padding: 8px 0; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 24px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            position: relative;
        }
        .sidebar-link .icon { font-size: 16px; min-width: 20px; text-align: center; }
        .sidebar-link:hover { color: #fff; background: rgba(255,255,255,0.06); }
        .sidebar-link.active { color: #fff; background: rgba(232,0,28,0.15); }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--red);
            border-radius: 0 3px 3px 0;
        }
        .badge {
            background: var(--red);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: auto;
        }
        .sidebar-bottom {
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-bottom .user-name {
            font-size: 13px;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px;
        }
        .sidebar-bottom form button {
            display: flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.5);
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            width: 100%;
            justify-content: center;
            transition: all 0.2s;
        }
        .sidebar-bottom form button:hover { background: rgba(255,255,255,0.08); color: #fff; }

        /* ── MAIN ─── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title { font-size: 18px; font-weight: 600; }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: var(--red); color: #fff; }
        .btn-primary:hover { opacity: 0.85; }
        .btn-secondary { background: #f0f0f0; color: #333; }
        .btn-secondary:hover { background: #e0e0e0; }
        .btn-danger { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover { background: #fecaca; }
        .btn-sm { padding: 6px 12px; font-size: 13px; }

        .content { padding: 32px; flex: 1; }

        /* ── CARD ─── */
        .card { background: #fff; border-radius: 10px; border: 1px solid #e5e5e5; overflow: hidden; }
        .card-header { padding: 20px 24px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; justify-content: space-between; }
        .card-header h3 { font-size: 16px; font-weight: 600; }
        .card-body { padding: 24px; }

        /* ── TABLE ─── */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #999; padding: 12px 16px; border-bottom: 1px solid #e5e5e5; background: #fafafa; }
        td { padding: 14px 16px; border-bottom: 1px solid #f5f5f5; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }
        .td-img img { width: 60px; height: 42px; object-fit: cover; border-radius: 4px; }

        /* ── FORM ─── */
        .form-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 500; color: #444; margin-bottom: 6px; }
        .form-group input[type=text],
        .form-group input[type=email],
        .form-group input[type=tel],
        .form-group input[type=number],
        .form-group input[type=color],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            background: #fff;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus { border-color: #111; }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .form-group .helper { font-size: 12px; color: #999; margin-top: 4px; }
        .toggle-wrap { display: flex; align-items: center; gap: 10px; }
        .toggle { position: relative; width: 44px; height: 24px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0;
            background: #ddd; border-radius: 24px; cursor: pointer; transition: 0.3s;
        }
        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 18px; height: 18px;
            left: 3px; top: 3px;
            background: #fff;
            border-radius: 50%;
            transition: 0.3s;
        }
        .toggle input:checked + .toggle-slider { background: var(--red); }
        .toggle input:checked + .toggle-slider::before { transform: translateX(20px); }

        /* ── ALERTS ─── */
        .alert { padding: 12px 16px; border-radius: 6px; font-size: 14px; margin-bottom: 20px; }
        .alert-success { background: #f0fdf4; border: 1px solid #86efac; color: #16a34a; }
        .alert-error { background: #fef2f2; border: 1px solid #fca5a5; color: #dc2626; }
        .field-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

        /* ── STATS ─── */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 28px; }
        .stat-card { background: #fff; border-radius: 10px; border: 1px solid #e5e5e5; padding: 24px; }
        .stat-card .stat-label { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #999; margin-bottom: 8px; }
        .stat-card .stat-value { font-size: 36px; font-weight: 700; line-height: 1; }
        .stat-card .stat-value.red { color: var(--red); }

        /* ── MEDIA GRID (project form) ─── */
        .media-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 16px; }
        .media-item { position: relative; border-radius: 6px; overflow: hidden; border: 1px solid #e0e0e0; }
        .media-item img, .media-item video { width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block; }
        .media-item-del {
            position: absolute; top: 4px; right: 4px;
            background: rgba(0,0,0,0.7);
            color: #fff; border: none; border-radius: 4px;
            padding: 4px 8px; font-size: 12px; cursor: pointer;
        }

        /* ── COLOR SWATCH ─── */
        .color-preview {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .color-swatch {
            width: 24px; height: 24px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }

        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .form-grid { grid-template-columns: 1fr; }
            .media-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">—<span>A</span>LBUS <small style="font-size:10px;opacity:0.4;font-weight:400">Admin</small></a>

    <nav class="sidebar-nav">
        <div class="sidebar-label">Genel</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span> Dashboard
        </a>

        <div class="sidebar-label">İçerik</div>
        <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <span class="icon">🎬</span> Projeler
        </a>
        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <span class="icon">🎭</span> Hizmetler
        </a>
        <a href="{{ route('admin.service-page-items.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-page-items.*') ? 'active' : '' }}">
            <span class="icon">📋</span> Hizmetlerimiz Sayfası
        </a>
        <a href="{{ route('admin.hero.index') }}" class="sidebar-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
            <span class="icon">🖼</span> Hero Slider
        </a>

        <div class="sidebar-label">İletişim</div>
        <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <span class="icon">✉️</span> Mesajlar
            @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span class="badge">{{ $unread }}</span>
            @endif
        </a>

        <div class="sidebar-label">Ayarlar</div>
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="icon">⚙️</span> Site Ayarları
        </a>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <span class="icon">🌐</span> Siteyi Görüntüle
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit">⏻ Çıkış Yap</button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="main-content">
    <div class="topbar">
        <span class="topbar-title">@yield('title', 'Dashboard')</span>
        <div class="topbar-actions">@yield('topbar-actions')</div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">⚠ {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
