@extends('layouts.admin')
@section('title', 'Projeler')

@section('topbar-actions')
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Yeni Proje</a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="60">Kapak</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Müşteri</th>
                    <th>Sıra</th>
                    <th>Öne Çıkan</th>
                    <th>Biz Kimiz</th>
                    <th>Durum</th>
                    <th width="160">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td class="td-img">
                        @if($project->cover_image)
                            <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}">
                        @else
                            <div style="width:60px;height:42px;background:#f0f0f0;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:20px">🎬</div>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px">
                            <div style="width:12px;height:12px;border-radius:50%;background:{{ $project->color ?? '#E8001C' }}"></div>
                            <strong>{{ $project->title }}</strong>
                        </div>
                    </td>
                    <td>{{ $project->category }}</td>
                    <td>{{ $project->client ?? '-' }}</td>
                    <td>{{ $project->order }}</td>
                    <td>
                        @if($project->is_featured)
                            <span style="color:#f59e0b">★ Evet</span>
                        @else
                            <span style="color:#ccc">–</span>
                        @endif
                    </td>
                    <td>
                        @if($project->show_on_about)
                            <span style="color:#7c3aed">● Evet</span>
                        @else
                            <span style="color:#ccc">–</span>
                        @endif
                    </td>
                    <td>
                        @if($project->is_active)
                            <span style="color:#16a34a;font-size:13px">● Aktif</span>
                        @else
                            <span style="color:#dc2626;font-size:13px">● Pasif</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary btn-sm">Düzenle</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Bu projeyi silmek istediğinizden emin misiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:#999;padding:48px">Henüz proje eklenmemiş. <a href="{{ route('admin.projects.create') }}" style="color:var(--red)">İlk projeyi ekle →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
