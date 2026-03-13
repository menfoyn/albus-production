@extends('layouts.admin')
@section('title', 'Hizmetlerimiz Sayfası')

@section('topbar-actions')
    <a href="{{ route('admin.service-page-items.create') }}" class="btn btn-primary">+ Yeni Hizmet Bloğu</a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="70">Görsel</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Maddeler</th>
                    <th>Sıra</th>
                    <th>Durum</th>
                    <th width="160">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="td-img">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                        @else
                            <div style="width:60px;height:42px;background:#f0f0f0;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:20px">📷</div>
                        @endif
                    </td>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td style="max-width:250px;color:#666">{{ Str::limit($item->description, 60) }}</td>
                    <td style="color:#666;font-size:13px">{{ $item->bullets ? count($item->bullets) . ' madde' : '—' }}</td>
                    <td>{{ $item->order }}</td>
                    <td>
                        @if($item->is_active)
                            <span style="color:#16a34a;font-size:13px">● Aktif</span>
                        @else
                            <span style="color:#dc2626;font-size:13px">● Pasif</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px">
                            <a href="{{ route('admin.service-page-items.edit', $item) }}" class="btn btn-secondary btn-sm">Düzenle</a>
                            <form action="{{ route('admin.service-page-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Silmek istediğinizden emin misiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:#999;padding:48px">
                        Henüz hizmet bloğu yok.
                        <a href="{{ route('admin.service-page-items.create') }}" style="color:var(--red)">İlk bloğu ekle →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
