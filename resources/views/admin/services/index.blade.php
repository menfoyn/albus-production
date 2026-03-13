@extends('layouts.admin')
@section('title', 'Hizmetler')

@section('topbar-actions')
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Yeni Hizmet</a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="70">Görsel</th>
                    <th>Başlık</th>
                    <th>Kısa Açıklama</th>
                    <th>Sıra</th>
                    <th>Durum</th>
                    <th width="160">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="td-img">
                        @if($service->cover_image)
                            <img src="{{ Storage::url($service->cover_image) }}" alt="{{ $service->title }}">
                        @else
                            <div style="width:60px;height:42px;background:#f0f0f0;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:20px">🎭</div>
                        @endif
                    </td>
                    <td><strong>{{ $service->title }}</strong></td>
                    <td style="max-width:300px;color:#666">{{ Str::limit($service->short_description, 80) }}</td>
                    <td>{{ $service->order }}</td>
                    <td>
                        @if($service->is_active)
                            <span style="color:#16a34a;font-size:13px">● Aktif</span>
                        @else
                            <span style="color:#dc2626;font-size:13px">● Pasif</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">Düzenle</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Silmek istediğinizden emin misiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#999;padding:48px">Henüz hizmet yok. <a href="{{ route('admin.services.create') }}" style="color:var(--red)">İlk hizmeti ekle →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
