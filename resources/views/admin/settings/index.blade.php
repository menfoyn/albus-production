@extends('layouts.admin')
@section('title', 'Site Ayarları')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div style="max-width:800px">
        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>Logo Ayarları</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Site Logosu (Navbar)</label>
                    @if(!empty($settings['site_logo']))
                        <div style="margin-bottom:10px; background:#1a1a1a; padding:16px; border-radius:8px; display:inline-block;">
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo" style="max-height:50px;">
                        </div>
                    @endif
                    <input type="file" name="site_logo" accept="image/*">
                    <div class="helper" style="margin-top:6px">Önerilen: Transparan PNG. Max 5MB.</div>
                </div>
                <div class="form-group">
                    <label>Footer Logosu</label>
                    @if(!empty($settings['footer_logo']))
                        <div style="margin-bottom:10px; background:#1a1a1a; padding:16px; border-radius:8px; display:inline-block;">
                            <img src="{{ asset('storage/' . $settings['footer_logo']) }}" alt="Footer Logo" style="max-height:50px;">
                        </div>
                    @endif
                    <input type="file" name="footer_logo" accept="image/*">
                    <div class="helper" style="margin-top:6px">Boş bırakılırsa site logosu kullanılır. Max 5MB.</div>
                </div>
                <div class="form-group">
                    <label>Footer Arka Plan Görseli</label>
                    @if(!empty($settings['footer_bg']))
                        <div style="margin-bottom:10px; border-radius:8px; overflow:hidden; display:inline-block;">
                            <img src="{{ asset('storage/' . $settings['footer_bg']) }}" alt="Footer BG" style="max-height:120px;">
                        </div>
                    @endif
                    <input type="file" name="footer_bg" accept="image/*">
                    <div class="helper" style="margin-top:6px">Footer alt kısmında görünecek arka plan resmi. Max 20MB.</div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>Genel Bilgiler</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Site Adı</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Albus Production' }}">
                </div>
                <div class="form-group">
                    <label>Slogan / Tagline</label>
                    <textarea name="site_tagline" rows="3">{{ $settings['site_tagline'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Footer Yazısı</label>
                    <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}">
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>İletişim Bilgileri</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>İletişim E-postası</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" placeholder="info@albusproduction.com">
                </div>
                <div class="form-group">
                    <label>Telefon</label>
                    <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="+90 xxx xxx xx xx">
                </div>
                <div class="form-group">
                    <label>Adres</label>
                    <textarea name="contact_address" rows="3" placeholder="Şirket adresi">{{ $settings['contact_address'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>Sosyal Medya</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/albusproduction">
                </div>
            </div>
        </div>

        {{-- ── Biz Kimiz Sayfası ── --}}
        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>Biz Kimiz – Açıklama & Görsel</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Açıklama Metni</label>
                    <textarea name="about_description" rows="4" placeholder="Etkinlik ve sahne prodüksiyonuna dair...">{{ $settings['about_description'] ?? 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel bir ekibiz.' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Bölüm Görseli</label>
                    @if(!empty($settings['about_image']))
                        <div style="margin-bottom:10px; background:#1a1a1a; padding:16px; border-radius:8px; display:inline-block;">
                            <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="About" style="max-height:120px;">
                        </div>
                    @endif
                    <input type="file" name="about_image" accept="image/*">
                    <div class="helper" style="margin-top:6px">Biz Kimiz sayfasında görünecek görsel. Max 50MB.</div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>Biz Kimiz – Misyonumuz</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Alt Başlık</label>
                    <input type="text" name="mission_subtitle" value="{{ $settings['mission_subtitle'] ?? 'Albus Production Olarak Sahnenize Hayat Veriyoruz' }}">
                </div>
                <div class="form-group">
                    <label>Misyon Metni</label>
                    <textarea name="mission_text" rows="5">{{ $settings['mission_text'] ?? 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde yaratıcı fikirleri ileri teknolojiyle buluşturuyor; projenizi eksiksiz ve sorunsuz şekilde hayata geçiriyoruz. Her ayrıntıyı sizin yerinize biz düşünürken, siz sadece izleyicilerinize unutulmaz bir deneyim sunmanın keyfini yaşayın.' }}</textarea>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card-header"><h3>Biz Kimiz – Vizyonumuz</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Vizyon Metni (1. Paragraf)</label>
                    <textarea name="vision_text_1" rows="4">{{ $settings['vision_text_1'] ?? 'Yeni teknolojileri ve anlatım biçimlerini cesurca kullanarak, sahneyi bir iletişim alanı olarak yeniden tanımlamak; izleyiciyle duygusal ve estetik bağ kuran deneyimler üretmek istiyoruz.' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Vizyon Metni (2. Paragraf)</label>
                    <textarea name="vision_text_2" rows="4">{{ $settings['vision_text_2'] ?? 'Amacımız yalnızca teknik yeterliliğiyle değil vizyoner bakış açısıyla da tercih edilen, ilham veren, ulusal ve uluslararası projelerde güvenilir bir iş ortağı olmaktır.' }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:14px 32px">💾 Ayarları Kaydet</button>
    </div>
</form>
@endsection
