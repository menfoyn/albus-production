@extends('layouts.admin')
@section('title', isset($item) ? 'Hizmet Bloğunu Düzenle' : 'Yeni Hizmet Bloğu')

@section('topbar-actions')
    <a href="{{ route('admin.service-page-items.index') }}" class="btn btn-secondary">← Geri</a>
@endsection

@section('content')
<form action="{{ isset($item) ? route('admin.service-page-items.update', $item) : route('admin.service-page-items.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($item)) @method('PUT') @endif

    @if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
    </div>
    @endif

    <div class="form-grid">
        {{-- Sol kolon --}}
        <div>
            <div class="card">
                <div class="card-header"><h3>Hizmet Bilgileri</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Başlık *</label>
                        <input type="text" name="title"
                               value="{{ old('title', $item->title ?? '') }}"
                               required placeholder="Örn: Görüntü Sistemleri">
                    </div>

                    <div class="form-group">
                        <label>Açıklama (sol taraf metni)</label>
                        <textarea name="description" rows="5"
                                  placeholder="Hizmetin sol tarafında görünecek açıklama metni">{{ old('description', $item->description ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Hizmet Kapsamı Maddeleri</label>
                        <textarea name="bullets" rows="8"
                                  placeholder="Her satıra bir madde yazın:&#10;İç ve dış mekân LED ekran sistemleri&#10;Özel ölçü ve formda LED tasarımları&#10;Transparan led, floor led, curve led">{{ old('bullets', isset($item) && $item->bullets ? implode("\n", $item->bullets) : '') }}</textarea>
                        <div class="helper">Her satır ayrı bir madde olarak gösterilir.</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sağ kolon --}}
        <div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Görsel</h3></div>
                <div class="card-body">
                    @if(isset($item) && $item->image)
                        <img src="{{ Storage::url($item->image) }}"
                             style="width:100%;border-radius:6px;margin-bottom:12px;aspect-ratio:16/9;object-fit:cover">
                    @endif
                    <input type="file" name="image" accept="image/*">
                    <div class="helper" style="margin-top:6px">Hizmetler sayfasında gösterilecek görsel. Max 20MB</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Ayarlar</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Sıralama</label>
                        <input type="number" name="order"
                               value="{{ old('order', $item->order ?? 0) }}" min="0">
                    </div>

                    <div class="form-group">
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span>Aktif / Yayında</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                        {{ isset($item) ? '💾 Güncelle' : '+ Kaydet' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
