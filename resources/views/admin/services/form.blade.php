@extends('layouts.admin')
@section('title', isset($service) ? 'Hizmeti Düzenle' : 'Yeni Hizmet')

@section('topbar-actions')
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">← Geri</a>
@endsection

@section('content')
<form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($service)) @method('PUT') @endif

    @if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
    </div>
    @endif

    <div class="form-grid">
        <div>
            <div class="card">
                <div class="card-header"><h3>Hizmet Bilgileri</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Başlık *</label>
                        <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required placeholder="Örn: 3D Sahne Tasarımı">
                    </div>
                    <div class="form-group">
                        <label>Kısa Açıklama</label>
                        <textarea name="short_description" rows="3" placeholder="Ana sayfada gösterilecek kısa açıklama">{{ old('short_description', $service->short_description ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Detaylı Açıklama</label>
                        <textarea name="description" rows="8" placeholder="Hizmetler sayfasında gösterilecek detaylı açıklama">{{ old('description', $service->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Kapak Görseli</h3></div>
                <div class="card-body">
                    @if(isset($service) && $service->cover_image)
                        <img src="{{ Storage::url($service->cover_image) }}" style="width:100%;border-radius:6px;margin-bottom:12px;aspect-ratio:16/9;object-fit:cover">
                    @endif
                    <input type="file" name="cover_image" accept="image/*">
                    <div class="helper" style="margin-top:6px">Max 20MB</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3>Ayarlar</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Sıralama</label>
                        <input type="number" name="order" value="{{ old('order', $service->order ?? 0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span>Aktif / Yayında</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                        {{ isset($service) ? '💾 Güncelle' : '+ Kaydet' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
