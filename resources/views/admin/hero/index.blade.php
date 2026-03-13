@extends('layouts.admin')
@section('title', 'Hero Slider')

@section('topbar-actions')
    <span style="font-size:13px;color:#999">Ana sayfanın tam ekran arka planı</span>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
    <!-- Yeni Medya Ekle -->
    <div class="card">
        <div class="card-header"><h3>Yeni Medya Ekle</h3></div>
        <div class="card-body">
            <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Dosya (Görsel veya Video) *</label>
                    <input type="file" name="file" accept="image/*,video/*" required>
                    <div class="helper">JPG, PNG, WebP, MP4. Videolar otomatik algılanır.</div>
                </div>
                <div class="form-group">
                    <label>Alt Metin (Opsiyonel)</label>
                    <input type="text" name="alt_text" placeholder="Açıklama metni">
                </div>
                <div class="form-group">
                    <label>Sıra</label>
                    <input type="number" name="order" value="{{ $slides->max('order') + 1 }}" min="0">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">+ Ekle</button>
            </form>
        </div>
    </div>

    <!-- Mevcut Slaytlar -->
    <div>
        <div class="card">
            <div class="card-header"><h3>Mevcut Slaytlar ({{ $slides->count() }})</h3></div>
            @if($slides->isEmpty())
                <div class="card-body" style="text-align:center;color:#999;padding:40px">
                    <p>Henüz slayt eklenmemiş.</p>
                </div>
            @else
            <div style="padding:16px;display:flex;flex-direction:column;gap:12px">
                @foreach($slides as $slide)
                <div style="display:flex;align-items:center;gap:12px;padding:12px;background:#f8f8f8;border-radius:8px;border:1px solid #e5e5e5">
                    <div style="width:80px;height:54px;overflow:hidden;border-radius:4px;flex-shrink:0;background:#111">
                        @if($slide->type === 'video')
                            <video src="{{ Storage::url($slide->file_path) }}" style="width:100%;height:100%;object-fit:cover" muted></video>
                        @else
                            <img src="{{ Storage::url($slide->file_path) }}" style="width:100%;height:100%;object-fit:cover">
                        @endif
                    </div>
                    <div style="flex:1;min-width:0">
                        <div style="font-size:12px;color:#999;margin-bottom:2px">{{ strtoupper($slide->type) }} · Sıra: {{ $slide->order }}</div>
                        <div style="font-size:13px;font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $slide->alt_text ?: basename($slide->file_path) }}</div>
                        <div style="margin-top:4px">
                            @if($slide->is_active)
                                <span style="color:#16a34a;font-size:12px">● Aktif</span>
                            @else
                                <span style="color:#dc2626;font-size:12px">● Pasif</span>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('admin.hero.destroy', $slide) }}" method="POST" onsubmit="return confirm('Sil?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">✕</button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
