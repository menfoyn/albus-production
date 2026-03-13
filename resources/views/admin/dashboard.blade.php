@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Toplam Proje</div>
        <div class="stat-value">{{ $stats['projects'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Hizmetler</div>
        <div class="stat-value">{{ $stats['services'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Toplam Mesaj</div>
        <div class="stat-value">{{ $stats['messages'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Okunmamış</div>
        <div class="stat-value red">{{ $stats['unread_messages'] }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Son Mesajlar</h3>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">Tümünü Gör</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gönderen</th>
                    <th>E-posta</th>
                    <th>Konu</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMessages as $msg)
                <tr>
                    <td><strong>{{ $msg->name }}</strong></td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->subject ?: '-' }}</td>
                    <td>{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        @if(!$msg->is_read)
                            <span style="background:#fef2f2;color:#dc2626;padding:3px 8px;border-radius:4px;font-size:12px;font-weight:600">Yeni</span>
                        @else
                            <span style="background:#f0f9f0;color:#16a34a;padding:3px 8px;border-radius:4px;font-size:12px">Okundu</span>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary btn-sm">Görüntüle</a></td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#999;padding:32px">Henüz mesaj yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px">
    <div class="card">
        <div class="card-header">
            <h3>Hızlı Erişim</h3>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:12px">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Yeni Proje Ekle</a>
            <a href="{{ route('admin.services.create') }}" class="btn btn-secondary">+ Yeni Hizmet Ekle</a>
            <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">🖼 Hero Slider Yönet</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Site Bilgisi</h3>
        </div>
        <div class="card-body">
            <p style="font-size:14px;color:#555;margin-bottom:12px">Sitenizin genel ayarlarını yönetin.</p>
            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">⚙️ Ayarları Düzenle</a>
        </div>
    </div>
</div>
@endsection
