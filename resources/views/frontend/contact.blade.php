@extends('layouts.app')
@section('title', 'İletişim – Albus Production')

@push('styles')
<style>
.contact-page {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
}
.contact-left {
    background: #0a0a1a;
    padding: 140px 64px 80px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: #fff;
}
.contact-left h1 {
    font-size: clamp(40px, 5vw, 64px);
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 40px;
}
.contact-info-list { display: flex; flex-direction: column; gap: 24px; margin-top: 48px; }
.contact-info-item .label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--red);
    margin-bottom: 4px;
}
.contact-info-item a,
.contact-info-item p {
    font-size: 16px;
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    line-height: 1.6;
}
.contact-info-item a:hover { color: #fff; }

.contact-right {
    padding: 140px 64px 80px;
    background: #fff;
}
.contact-right h2 { font-size: 28px; font-weight: 700; margin-bottom: 8px; }
.contact-right .subtitle { font-size: 14px; color: #888; margin-bottom: 48px; }

.form-group { margin-bottom: 24px; }
.form-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #999;
    margin-bottom: 8px;
}
.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 15px;
    font-family: inherit;
    background: #fafafa;
    transition: border-color 0.2s, background 0.2s;
    outline: none;
    color: #111;
}
.form-group input:focus,
.form-group textarea:focus {
    border-color: #111;
    background: #fff;
}
.form-group textarea { resize: vertical; min-height: 120px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

.alert-success {
    background: #f0fdf4;
    border: 1px solid #86efac;
    color: #16a34a;
    padding: 14px 18px;
    border-radius: 6px;
    margin-bottom: 24px;
    font-size: 14px;
}
.alert-error {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    color: #dc2626;
    padding: 14px 18px;
    border-radius: 6px;
    margin-bottom: 24px;
    font-size: 14px;
}
.field-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

@media (max-width: 900px) {
    .contact-page { grid-template-columns: 1fr; }
    .contact-left { padding: 120px 24px 48px; }
    .contact-right { padding: 48px 24px 60px; }
    .form-row { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="contact-page">
    <!-- SOL -->
    <div class="contact-left">
        <div>
            <h1>Proje Talebi<br>Oluştur</h1>
            <p style="font-size:15px;color:rgba(255,255,255,0.5);line-height:1.7;max-width:320px">
                Projeniz için bizimle iletişime geçin. En kısa sürede size dönüş yapacağız.
            </p>
        </div>
        <div class="contact-info-list">
            <div class="contact-info-item">
                <div class="label">E-posta</div>
                <a href="mailto:info@albusproduction.com">info@albusproduction.com ↗</a>
            </div>
            <div class="contact-info-item">
                <div class="label">Instagram</div>
                <a href="https://www.instagram.com/albusproduction" target="_blank">@albusproduction ↗</a>
            </div>
            <div class="contact-info-item">
                <div class="label">Adres</div>
                <p>Çırçır Mah. Tatlıkuyu Cad.<br>Tatlıkuyu OSB Blok No:17/A05<br>34235, Esenler/İstanbul</p>
            </div>
        </div>
    </div>

    <!-- SAĞ / FORM -->
    <div class="contact-right">
        <h2>Bize Ulaşın</h2>
        <p class="subtitle">Tüm alanları doldurarak mesajınızı gönderin.</p>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="alert-error">
            <strong>Lütfen aşağıdaki hataları düzeltin:</strong>
            <ul style="margin-top:8px;padding-left:16px">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Ad Soyad *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Adınız Soyadınız">
                    @error('name')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="company">Şirket</label>
                    <input type="text" id="company" name="company" value="{{ old('company') }}" placeholder="Şirket Adı">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">E-posta *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="ornek@email.com">
                    @error('email')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+90 5xx xxx xx xx">
                </div>
            </div>
            <div class="form-group">
                <label for="subject">Konu</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Proje konusu">
            </div>
            <div class="form-group">
                <label for="message">Mesaj *</label>
                <textarea id="message" name="message" required placeholder="Projeniz hakkında bilgi verin...">{{ old('message') }}</textarea>
                @error('message')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-red" style="width:100%;justify-content:center;padding:16px">
                Mesaj Gönder →
            </button>
        </form>
    </div>
</div>
@endsection
