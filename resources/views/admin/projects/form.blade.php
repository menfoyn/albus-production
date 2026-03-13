@extends('layouts.admin')
@section('title', isset($project) ? 'Projeyi Düzenle' : 'Yeni Proje')

@section('topbar-actions')
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">← Geri</a>
@endsection

@section('content')
<form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($project)) @method('PUT') @endif

    @if(session('error'))
    <div class="alert alert-error">
        <strong>⚠️ Hata:</strong> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-error">
        <strong>Hata:</strong>
        <ul style="margin-top:8px;padding-left:16px">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <div class="form-grid">
        <!-- Sol: Ana bilgiler -->
        <div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Temel Bilgiler</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Proje Başlığı * <small style="font-weight:400;color:#888">(Alt satır için Enter'a bas)</small></label>
                        <textarea name="title" rows="2" required placeholder="Örn: Kültür&#10;Bakanlığı" style="resize:vertical">{{ old('title', $project->title ?? '') }}</textarea>
                        @error('title')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select name="category" required>
                                <option value="">Seçin...</option>
                                @foreach(['konser' => 'Konser & Festival & Tiyatro', 'toplanti' => 'Toplantı & Konferans', 'lansman' => 'Lansman & Gala & Sergi', 'fuar' => 'Fuar & Stand Uygulamaları'] as $catKey => $catLabel)
                                <option value="{{ $catKey }}" {{ old('category', $project->category ?? '') == $catKey ? 'selected' : '' }}>{{ $catLabel }}</option>
                                @endforeach
                            </select>
                            @error('category')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label>Müşteri / Marka</label>
                            <input type="text" name="client" value="{{ old('client', $project->client ?? '') }}" placeholder="Örn: Türk Telekom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kısa Etiket <small style="font-weight:400;color:#888">(Kartta görünecek kısa kategori, örn: Lansman, Konser, Gala)</small></label>
                        <input type="text" name="short_label" value="{{ old('short_label', $project->short_label ?? '') }}" placeholder="Örn: Lansman">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                        <div class="form-group">
                            <label>Konum</label>
                            <input type="text" name="location" value="{{ old('location', $project->location ?? '') }}" placeholder="Örn: Atatürk Kültür Merkezi">
                        </div>
                        <div class="form-group">
                            <label>Tarih</label>
                            <input type="text" name="date" value="{{ old('date', $project->date ?? '') }}" placeholder="Örn: Ocak 2025">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kısa Açıklama</label>
                        <textarea name="short_description" rows="2" placeholder="Portfolyo kartında gösterilecek kısa açıklama (max 200 karakter)">{{ old('short_description', $project->short_description ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Detaylı Açıklama</label>
                        <textarea name="description" rows="6" placeholder="Proje detay sayfasında gösterilecek uzun açıklama">{{ old('description', $project->description ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Alıntı / Açıklama Metni</label>
                        <textarea name="quote_text" rows="3" placeholder="Sağ kolonda alıntı olarak gösterilecek metin">{{ old('quote_text', $project->quote_text ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hero Görsel Pozisyonu</label>
                        <input type="text" name="hero_image_position" value="{{ old('hero_image_position', $project->hero_image_position ?? '50% 50%') }}" placeholder="Örn: 78% 55% veya center">
                        <div class="helper">CSS object-position değeri. Görselin odak noktasını ayarlar.</div>
                    </div>
                    <div class="form-group">
                        <label>Hero Görsel Zoom (Yakınlık)</label>
                        <input type="number" name="hero_image_zoom" value="{{ old('hero_image_zoom', $project->hero_image_zoom ?? 1) }}" placeholder="1" min="0.1" max="2" step="0.05">
                        <div class="helper">1 = normal. 0.8 = uzaktan/küçük. 1.2 = yakın/büyük.</div>
                    </div>
                </div>
            </div>

            <!-- Detay Sayfası Videoları -->
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Detay Sayfası Videoları</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tanıtım Videosu (Hero)</label>
                        @if(isset($project) && $project->hero_video)
                            <div style="margin-bottom:12px">
                                <video src="{{ Storage::url($project->hero_video) }}" style="width:100%;max-height:200px;border-radius:6px;background:#000" controls></video>
                                <div class="helper" style="margin-top:4px">Mevcut video yüklü. Yeni dosya seçerseniz üzerine yazılır.</div>
                            </div>
                        @endif
                        <input type="file" name="hero_video" accept="video/mp4,video/quicktime,video/webm">
                        <div class="helper">MP4, MOV, WebM desteklenir. Max 500MB. "Tanıtımı İzle" butonuna tıklandığında oynatılır.</div>
                        @error('hero_video')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Sol Kolon Videosu (Loop / Arka Plan)</label>
                        @if(isset($project) && $project->intro_video)
                            <div style="margin-bottom:12px">
                                <video src="{{ Storage::url($project->intro_video) }}" style="width:100%;max-height:200px;border-radius:6px;background:#000" controls></video>
                                <div class="helper" style="margin-top:4px">Mevcut video yüklü. Yeni dosya seçerseniz üzerine yazılır.</div>
                            </div>
                        @endif
                        <input type="file" name="intro_video" accept="video/mp4,video/quicktime,video/webm">
                        <div class="helper">MP4, MOV, WebM desteklenir. Max 500MB. Sol kolonda otomatik oynatılır (muted, loop).</div>
                        @error('intro_video')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- Detay Sayfası Sağ Görsel -->
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Detay Sayfası Sağ Görsel</h3></div>
                <div class="card-body">
                    @if(isset($project) && $project->intro_image)
                        <img src="{{ Storage::url($project->intro_image) }}" style="width:100%;border-radius:6px;margin-bottom:12px;aspect-ratio:664/718;object-fit:cover">
                    @endif
                    <div class="form-group">
                        <input type="file" name="intro_image" accept="image/*">
                        <div class="helper">Önerilen: 664×718px. Max 20MB. Sağ kolonda büyük görsel olarak gösterilir.</div>
                        @error('intro_image')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- Medya Galerisi -->
            <div class="card">
                <div class="card-header"><h3>Proje Görselleri / Videoları</h3></div>
                <div class="card-body">
                    @if(isset($project) && $project->media->isNotEmpty())
                    <div class="media-grid">
                        @foreach($project->media as $media)
                        <div class="media-item" id="media-item-{{ $media->id }}">
                            @if($media->type === 'video')
                                <video src="{{ Storage::url($media->file_path) }}" muted></video>
                            @else
                                <img src="{{ Storage::url($media->file_path) }}" alt="Medya">
                            @endif
                            <button type="button" class="media-item-del" onclick="deleteMedia({{ $media->id }})" title="Sil">✕</button>
                        </div>
                        @endforeach
                    </div>
                    <div style="margin-top:16px;padding-top:16px;border-top:1px solid #f0f0f0"></div>
                    @endif
                    <div class="form-group">
                        <label>{{ isset($project) && $project->media->isNotEmpty() ? 'Yeni Medya Ekle' : 'Görseller / Videolar' }}</label>
                        <input type="file" name="media_files[]" multiple accept="image/*,video/*">
                        <div class="helper">JPG, PNG, WebP, MP4 desteklenir. Birden fazla dosya seçebilirsiniz. Max 500MB/dosya.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sağ: Kapak, ayarlar -->
        <div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Kapak Görseli</h3></div>
                <div class="card-body">
                    @if(isset($project) && $project->cover_image)
                        <img src="{{ Storage::url($project->cover_image) }}" style="width:100%;border-radius:6px;margin-bottom:12px;aspect-ratio:16/9;object-fit:cover">
                    @endif
                    <div class="form-group">
                        <input type="file" name="cover_image" accept="image/*">
                        <div class="helper">Önerilen: 1200×800px. Max 20MB.</div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3>Kart Rengi</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Portfolyo kartının arka plan rengi</label>
                        <div class="color-preview">
                            <input type="color" name="color" id="colorPicker" value="{{ old('color', $project->color ?? '#E8001C') }}" style="width:48px;height:36px;padding:2px;cursor:pointer">
                            <span id="colorHex">{{ old('color', $project->color ?? '#E8001C') }}</span>
                        </div>
                        <div style="display:flex;gap:8px;margin-top:12px;flex-wrap:wrap">
                            @foreach(['#E8001C','#0B2FCA','#111111','#1a472a','#7c3aed','#d97706'] as $preset)
                            <button type="button" onclick="document.getElementById('colorPicker').value='{{ $preset }}';document.getElementById('colorHex').textContent='{{ $preset }}'"
                                style="width:28px;height:28px;border-radius:50%;background:{{ $preset }};border:2px solid #e0e0e0;cursor:pointer"></button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Yayın Ayarları</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Sıralama</label>
                        <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}" min="0" placeholder="0">
                        <div class="helper">Küçük sayı önce gelir.</div>
                    </div>
                    <div class="form-group">
                        <label>Öne Çıkan (Ana Sayfa)</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span>Ana sayfada göster</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Biz Kimiz Sayfası</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="hidden" name="show_on_about" value="0">
                                <input type="checkbox" name="show_on_about" value="1" {{ old('show_on_about', $project->show_on_about ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span>Biz Kimiz sayfasında göster (max 3)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Yayın Durumu</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span>Aktif / Yayında</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px">
                        {{ isset($project) ? '💾 Güncelle' : '+ Projeyi Kaydet' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.getElementById('colorPicker').addEventListener('input', function() {
    document.getElementById('colorHex').textContent = this.value;
});

function deleteMedia(mediaId) {
    if (!confirm('Bu medyayı silmek istediğinize emin misiniz?')) return;

    fetch('/admin/proje-medya/' + mediaId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(function(response) {
        if (response.ok) {
            var el = document.getElementById('media-item-' + mediaId);
            if (el) el.remove();
        } else {
            alert('Medya silinirken bir hata oluştu.');
        }
    })
    .catch(function() {
        alert('Bağlantı hatası. Lütfen tekrar deneyin.');
    });
}
</script>
@endpush
